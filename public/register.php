<?php $page_name="Register"?>
<?php require 'head.php';?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <?php 
        $form = checkFormParams(array("pmo_fname", "pmo_lname", "pmo_email"));
        if($form["cnt"] == 3){
          // echo "Post";
          $result = getById("pmo_user", "userEmail", $form["pmo_email"]);
          if(isset($result)){
            $error = "duplicate";
          } else {
            // Generate Random Password
            $newPass = randomPassword();
            
            // Generate Hash
            $newPassHash = passHash($newPass);

            // Save Password in Database
            $id = insertFields("pmo_user", 
                array("userFname" => $form["pmo_fname"], 
                      "userLname" => $form["pmo_lname"], 
                      "userEmail" => $form["pmo_email"], 
                      "userPassword" => $newPassHash)
                );

            // Email Password to User
            $error = "success";
          }
        } else {
          $error = "";  
        }
      ?>
      <h2 class="page-header">New User? Register</h2>
      
      <form role="form" id="userRegistration" method="POST">
        <div id="errors"></div>
        <?php 
        if($error == "success"){ ?>
          <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              User Registered, password: <?php echo $newPass?>
          </div>
        <?php } ?>

        <?php 
        if($error == "duplicate"){ ?>
          <div class="alert alert-danger alert-dissmisible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Duplicate User!!!
          </div>
        <?php } ?>

        <div class="form-group">
            <label>First Name</label>
            <input id="pmo_fname" name="pmo_fname" class="form-control">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input id="pmo_lname" name="pmo_lname" class="form-control">
        </div>
        <div class="form-group">
            <label>Email Address</label>
            <input id="pmo_email" name="pmo_email" class="form-control" placeholder="example@domain.com">
            <p class="help-block">Your email address will be your username</p>
        </div>
        
        
        <a href="javascript:submitRegistration();" class="btn btn-primary">Register</a>
        <button type="reset" class="btn btn-default">Reset</button>
      </form>
    </div>
    
  </div>
  <!-- /.row -->
</div><!-- /#page-wrapper -->


<script type="text/javascript">
  
  function submitRegistration(){
      var formerrors = "";    

      if(document.getElementById("pmo_fname").value == "" || document.getElementById("pmo_fname").value == null) {
        formerrors += "Enter First Name. <br/>"
      }
      if(document.getElementById("pmo_lname").value == "" || document.getElementById("pmo_lname").value == null) {
        formerrors += "Enter Last Name. <br/>"
      }
      if(document.getElementById("pmo_email").value == "" || document.getElementById("pmo_email").value == null) {
        formerrors += "Enter valid email address.<br/>"
      }

      if (formerrors == "" || formerrors == null) {
        document.forms["userRegistration"].action = "register.php";
        document.forms["userRegistration"].submit();
      } else {
        document.getElementById("errors").innerHTML = formerrors;
        document.getElementById("errors").className="alert alert-danger";
      }

    }

</script>

<?php include("footer.php"); ?>
