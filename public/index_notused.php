<!doctype html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="img/favicon/favicon.ico" />
  <title>PM&amp;O - SP1 (Group 1 / CS673: SDPM)</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <script src="js/respond.js"></script>
  <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
</head>

<?php require_once("../includes/Sessions.inc"); ?>

<body>
	<div class="container" style="margin-top:60px">
	    
	  	<div class="row vertical-offset-100">
		    <div class="col-md-6 col-md-offset-3">
		      	<div class="panel panel-default">
			        <div class="panel-heading">
			            <h3 class="panel-title"><strong>Sign in to continue</strong></h3>
			        </div> <!-- Div panel-heading -->

			        <div class="panel-body">
			          <div class="center-block text-center">
			            <img class="profile-img" src="img/productlogo.png" alt="">
			          </div>

			          <div class="center-block text-center">
			          	<h3><span class="label label-danger"><?php echo message(); ?></span></h3>
			          </div>
			          <form role="form" action="authenticate.php" method="POST">
			          	<fieldset>
			              <div class="row">
			                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
			                  <div class="form-group">
			                    <div class="input-group">
			                      <span class="input-group-addon">
			                          <i class="glyphicon glyphicon-user"></i>
			                      </span> 
			                      <input class="form-control" placeholder="Username" name="syllabi_username" type="text" autofocus>
			                    </div>
			                  </div>
			                  <div class="form-group">
			                      <div class="input-group">
			                          <span class="input-group-addon">
			                              <i class="glyphicon glyphicon-lock"></i>
			                          </span>
			                          <input class="form-control" placeholder="Password" name="syllabi_password" type="password" value="">
			                      </div>
			                  </div>
			                  <div class="form-group">
			                      <input type="submit" name="submit" class="btn btn-lg btn-primary btn-block" value="Sign in">
			                  </div>
			                </div>
			              </div> <!-- Div row -->
				          </fieldset>
			          </form>
			      	</div> <!-- Div panel-body -->
		    	</div> <!-- Div panel panel-default -->
		    	<h4 class="text-center"><a href="register.php">New User? Register</a></h4>
		  	</div>

		  	

	  	</div>
	</div> <!-- Div container -->


	
</body>
</html>