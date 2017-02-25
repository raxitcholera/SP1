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