<?php 
require_once("../includes/Sessions.inc"); 
require_once('../includes/AuthenticationFunctions.inc');
require_once('../includes/Functions.inc');


if (isset($_POST['submit'])) {

	// User-provided info
	$fname = $_POST['pmo_fname'];
	$lname = $_POST['pmo_lname'];
	$email = $_POST['pmo_email'];

	

	if ($authentication_status) {
		//Successfully authenticated in ldap, redirect to home
		redirectTo("myhome.php");
	} 
	else {
		$_SESSION["message"] = "Login failed!!!";
		redirectTo("index.php");
	}
}

