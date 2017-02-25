<!doctype html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="img/favicon/favicon.ico" />
  <title>PM&amp;O - SP1 (Group 1 / CS673: SDPM)</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <!-- Template CSS -->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<?php require_once("../includes/Sessions.inc"); ?>

<body>
	<div class="container" style="margin-top:60px">
	    
	  	<div class="row vertical-offset-100">
		    <div class="col-md-6 col-md-offset-3">
		      	<div class="panel panel-default">
			        <div class="panel-heading">
			            <h3 class="panel-title"><strong>New User Registration</strong></h3>
			        </div> <!-- Div panel-heading -->

			        <div class="panel-body">
			          <div class="center-block text-center">
			            <img class="profile-img" src="img/productlogo.png" alt="">
			          </div>

			          <div class="center-block text-center">&nbsp;</div>

			          
			          	<div id="errors" class="center-block text-center">
                  			&nbsp;
                  		</div>
			          
			          <form role="form" name="registerform" id="registerform" method="POST">
			          	<fieldset>
			              <div class="row">
			                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
			                  <div class="form-group">
			                    <div class="input-group">
			                      <span class="input-group-addon">
			                          <i class="glyphicon glyphicon-user"></i>
			                      </span> 
			                      <input class="form-control" placeholder="First Name" id="pmo_fname" name="pmo_fname" type="text" autofocus>
			                    </div>
			                  </div>
			                  <div class="form-group">
			                      <div class="input-group">
			                          <span class="input-group-addon">
			                              <i class="fa fa-group"></i>
			                          </span>
			                          <input class="form-control" placeholder="Last Name" id="pmo_lname" name="pmo_lname" type="text" value="">
			                      </div>
			                  </div>
			                  <div class="form-group">
			                      <div class="input-group">
			                          <span class="input-group-addon">
			                              <i class="fa fa-envelope"></i>
			                          </span>
			                          <input class="form-control" placeholder="example@domain.com" id="pmo_email" name="pmo_email" type="text" value="">
			                      </div>
			                      <p class="help-block">Your email address will be your username</p>
			                  </div>
			                  <div class="form-group">
			                      <a href="javascript:submitForm()" name="submit" class="btn btn-lg btn-primary btn-block" value="Sign up">Submit</a>
			                  </div>
			                </div>
			              </div> <!-- Div row -->
				          </fieldset>
			          </form>
			      	</div> <!-- Div panel-body -->
		    	</div> <!-- Div panel panel-default -->
		    	<h4 class="text-center"><a href="index.php">Back to Login?</a></h4>
		  	</div>

		  	

	  	</div>
	</div> <!-- Div container -->	

	<script type="text/javascript">
	function submitForm(){
	    var formerrors = "";
	    if(document.getElementById("pmo_email").value == "" || document.getElementById("pmo_email").value == null) {
	      formerrors += "Enter valid email address.<br/>"
	    }
	    if(document.getElementById("pmo_lname").value == "" || document.getElementById("pmo_lname").value == null) {
	      formerrors += "Enter Last Name. <br/>"
	    }

	    if(document.getElementById("pmo_fname").value == "" || document.getElementById("pmo_fname").value == null) {
	      formerrors += "Enter First Name. <br/>"
	    }

	    if (formerrors == "" || formerrors == null) {
	      document.forms["registerform"].action = "registeruser.php";
	      document.forms["registerform"].submit();
	    } else {
	      document.getElementById("errors").innerHTML = formerrors;
	      document.getElementById("errors").className="alert alert-danger";
	    }

	  }
	</script>


</body>





</html>