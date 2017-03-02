<?php 
require_once("../includes/DatabaseFunctions.php");

// Defaul Color Values by Sessions
$color= array(
	'A' => "green",
	'B' => "yellow",
	'C' => "primary",
	'D' => "danger",
	);
$button_color= array(
	'A' => "success",
	'B' => "warning",
	'C' => "primary",
	'D' => "danger",
	);
$pagination_color= array(
	'A' => "5cb85c",
	'B' => "f0ad4e",
	'C' => "337ab7",
	'D' => "337ab7",
	);


// Redirect Page to URI
function redirectTo($page) {
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/$page");
  ob_end_flush();
  exit;
}


// Check if User Is Logged In
function isLoggedIn() {
	if (!isset($_SESSION["authenticated"])) {
		return false;
	} else {
		return true;
	}
}


// Convert Date
function dateMath($queryDate, $dateString) {
	$date=date_create($queryDate);
	date_add($date, date_interval_create_from_date_string($dateString));
	return strtotime(date_format($date, 'Y-m-d H:i:s'));
}


// Check Query Parameters and Return Array of all Params
function checkQueryParams($param_array){
	$cnt = 0;
	for($i=0; $i < count($param_array); $i++){
		if(isset($_GET[$param_array[$i]])){
			$params_set[$param_array[$i]] = $_GET[$param_array[$i]];
			$cnt++;
		}
		$params_set["cnt"] = $cnt;
	}
	return $params_set;
}


// Check Form Post Parameters and Return Array of all Params
function checkFormParams($param_array){
	$cnt = 0;
	for($i=0; $i < count($param_array); $i++){
		if(isset($_POST[$param_array[$i]])){
			$params_set[$param_array[$i]] = $_POST[$param_array[$i]];
			$cnt++;
		}
		$params_set["cnt"] = $cnt;
	}
	return $params_set;
}


// Return Current Server Date in DB Format
function currentDate(){
	$date = date("Y-m-d H:i:s");
	return $date;
}


// Pad Strings with Preceding Zeros
function padString($number, $pad_len){
	$result=null;
	for($i=0; $i < $pad_len - strlen($number); $i++){
		$result .= "0";
	}
	$result .= $number;
	return $result;
}


// Generate Query String from Associative Array
function queryString($param_array){
	$cnt = 0;
	$qstring = null;
	foreach ($param_array as $key => $value){
		if($cnt > 0){
			$qstring .= "&" . $key . "=" . $value;
		} else {
			$qstring = $key . "=" . $value;
		}
		$cnt++;
	}
	return $qstring;
}

// Generate Random Password
function randomPassword() {
	$set = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = strlen($set);
    $passLength = rand(8,12);
    $randomPass = '';

    for ($i = 0; $i < $passLength; $i++) {
        $randomPass .= $set[rand(0, $length - 1)];
    }
    return $randomPass;
}


// Generate Password Hash
function passHash($password) {
	$options = [
    'cost' => 12,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	];
	$theHash = password_hash($password, PASSWORD_BCRYPT, $options);
	return $theHash;
}


// Verify Username and Password
function isValidUser($username, $password) {
	$result = getById("pmo_user", "userEmail", $username);
	if(isset($result)){
		if(password_verify ($password, $result["userPassword"]) == 1){
			$_SESSION["authenticated"] = true;
			$_SESSION["pmo_username"] = $result["userEmail"];
			$_SESSION["pmo_fname"] = $result["userFname"];
			$_SESSION["pmo_lname"] = $result["userLname"];
			$_SESSION["pmo_id"] = $result["id"];
			return true;
		} 
	}
	return false;
}


// Get Current Stock Price
function currentStockPrice($ticker, $exchange) {
	$arrContextOptions=array(
    	"ssl"=>array(
    	    "verify_peer"=>false,
        	"verify_peer_name"=>false,
        ),
	);

	$xml = "http://finance.google.com/finance/info?client=ig&q=" . $exchange . ":" . $ticker;
	
	$json = file_get_contents($xml, true, stream_context_create($arrContextOptions));
	$json = substr($json, 4);
	$array = json_decode($json,TRUE);
	$result = $array[0];
	return $result;
}

// Get Current Stock Price
function currentExchange($combo) {
	$arrContextOptions=array(
    	"ssl"=>array(
    	    "verify_peer"=>false,
        	"verify_peer_name"=>false,
        ),
	);

	

	$xml = "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.xchange%20where%20pair%20in%20(%22" . $combo . "%22)&diagnostics=true&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
	//echo $xml;
	$json = file_get_contents($xml, true, stream_context_create($arrContextOptions));
	//$json = substr($json, 4);
	$array = json_decode($json,TRUE);
	//var_dump($array);
	$result = $array["query"]["results"]["rate"]["Rate"];
	return $result;
}

// Get Stock Price for a specific date range
function historicalStockPrice($ticker, $exchange, $start, $end) {
	$arrContextOptions=array(
    	"ssl"=>array(
    	    "verify_peer"=>false,
        	"verify_peer_name"=>false,
        ),
	);

	if($exchange == "NSE"){
		$ticker = $ticker . ".NS";
	}

	$hendDate = $end; 
	$hstartDate = $start; 

	$url = "https://query.yahooapis.com/v1/public/yql?q=";
	$url.= urlencode("select * from yahoo.finance.historicaldata where symbol =\"" . $ticker . "\" and startDate=\"" . $hstartDate . "\" and endDate=\"". $hendDate . "\"");
	$url.= "&format=json&diagnostics=true&env=";
	$url.= urlencode("store://datatables.org/alltableswithkeys");
	$url.= "&callback=";
	
	
	$hjson = file_get_contents($url, true, stream_context_create($arrContextOptions));
	
	$harray = json_decode($hjson,TRUE);
	
	if($harray["query"]["count"] == 1){
		$result[0] = $harray["query"]["results"]["quote"];	
	} else {
		$result = $harray["query"]["results"]["quote"];	
	}

	
	return $result;
}