<?php ob_start();?>
<?php require_once("../includes/Sessions.php"); ?>
<?php require_once("../includes/Functions.php"); ?>

<?php isLoggedIn(); 

if(!isset($page_name)) {
	$page_name=" ";
}

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="img/favicon/favicon.ico" />

  <title>PM&amp;O / Group 1</title>
  
  <!-- CSS for Data Table
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.css"> -->

  <!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="css/metisMenu.min.css" rel="stylesheet">

	<!-- DataTables CSS -->
  <link href="css/dataTables.bootstrap.css" rel="stylesheet">

  <!-- DataTables Responsive CSS
  <link href="css/dataTables.responsive.css" rel="stylesheet">  -->

  <!-- Timeline CSS -->
  <link href="css/timeline.css" rel="stylesheet">

	<!-- Template CSS -->
	<link href="css/sb-admin-2.css" rel="stylesheet">


	<!-- Custom Fonts -->
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>

<body>



