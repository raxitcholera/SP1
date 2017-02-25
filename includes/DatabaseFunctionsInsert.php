<?php 
// General
// -- Create a Blank Record
// @param: expects table name
function insertBlank($table) {

	global $connection;

	$query  = "INSERT INTO {$table}";
	
	// echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $connection->insert_id;
}


// General
// -- Create a Blank Record with selected fields
// @param: expects table, fields_array
function insertFields($table, $fields_array) {
	$keys = null;
	$values = null;
	global $connection;

	$query  = "INSERT INTO {$table}";
	$i = 0;

	foreach($fields_array as $key => $value){
		$value1 = mysqli_real_escape_string($connection, $value);
		
		if($i == 0) {
			$keys .= " {$key}";
			$values .= "'{$value1}'";	
		} else {
			$keys .= ", {$key}";
			$values .= ", '{$value1}'";	
		}
		$i++;
	}
	$query .= "(";
	$query .= $keys;
	$query .= ")";
	$query .= " VALUES (";
	$query .= $values;
	$query .= ")";
	
	// echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $connection->insert_id;
}


// pmo_cash, pmo_portfolio
// -- Allows you to add cash (add cash or sell stocks)
// @param: pid, date, amount, action
function addCash($pid, $date, $amount, $action) {
	$cid = insertFields("pmo_cash", array("pid" => $pid, "cash_date" => $date, "cash_amount" => $amount, "cash_action" => $action));
	$balance = getById("pmo_portfolio", "pid", $pid)["portfolio_cash"];
	
	$balance = (floatval($balance) + floatval($amount));
	
	updateById("pmo_portfolio", "pid", $pid, array("portfolio_cash" => $balance));
	return $cid;
}



// pmo_cash, pmo_portfolio
// -- Allows you to withdraw cash (withdraw cash or buy stocks)
// @param: pid, date, amount, action
function withdrawCash($pid, $date, $amount, $action) {
	$cid = insertFields("pmo_cash", array("pid" => $pid, "cash_date" => $date, "cash_amount" => $amount, "cash_action" => $action));
	$balance = getById("pmo_portfolio", "pid", $pid)["portfolio_cash"];
	
	$balance = (floatval($balance) - floatval($amount));
	
	updateById("pmo_portfolio", "pid", $pid, array("portfolio_cash" => $balance));
	return $cid;
}