<?php $page_name="Login/Register"?>
<?php require 'head.php';?>
<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>



<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-6">
      <h2 class=page-header>About PM&amp;O</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu neque tempor, elementum leo et, accumsan mauris. Aliquam est urna, posuere sed dolor et, placerat vulputate dolor. Fusce in malesuada leo, nec pharetra orci. Fusce vitae laoreet erat. Etiam bibendum nulla nec ultricies rhoncus. In vel eleifend lacus. Sed vitae justo nunc. Vestibulum congue fermentum diam, eget scelerisque augue tristique a. Morbi ut gravida nibh. Mauris tempus, arcu a feugiat tristique, nisi massa eleifend libero, in lobortis ex quam vel ligula. Nam et diam condimentum, efficitur leo vel, maximus odio. Sed ac sem quam. Vivamus tempus tellus vel sollicitudin convallis. Pellentesque vulputate ligula ut tempus pellentesque.</p>

      <div class="list-group">
        <a href="#" class="list-group-item">
          Product Features
        </a>
        <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item">Morbi leo risus</a>
        <a href="#" class="list-group-item">Porta ac consectetur ac</a>
        <a href="#" class="list-group-item">Vestibulum at eros</a>
      </div>
    </div>
    <div class="jumbotron col-lg-6">
      <?php 
        $form = checkFormParams(array("pmo_username", "pmo_password"));
        if($form["cnt"] == 2){
          if(isValidUser($form["pmo_username"], $form["pmo_password"])){
            $login = "Yes";
            redirectTo("myhome.php"); 
          } else {
            $login = "No";
          }
        } else {
          $login = "";
        }
      ?>
      <h2>Login</h2>
      <form role="form" id="userLogin" method="POST">
        <div id="errors">
          
        </div>
        <?php 
        if($login == "No"){ ?>
          <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Username or Password Incorrect!!!
          </div>
        <?php } ?>
        <div class="form-group">
            <label>Username</label>
            <input id="pmo_username" name="pmo_username" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input id="pmo_password" name="pmo_password" type="password" class="form-control">
        </div>
        <a href="javascript:submitLogin();" class="btn btn-success">Login</a>
        <button type="reset" class="btn btn-default">Reset</button>
        <a class="help-block">Forgot Password?</a>
        <a href="register.php"><h3 class="text-primary">New User? Register here</h3></a>
      </form>
    </div>
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-lg-12">
      

    </div>
  </div>

</div><!-- /#page-wrapper -->


<script type="text/javascript">

  function submitLogin(){
      var formerrors = "";    

      if(document.getElementById("pmo_username").value == "" || document.getElementById("pmo_username").value == null) {
        formerrors += "Enter Username. <br/>"
      }
      if(document.getElementById("pmo_password").value == "" || document.getElementById("pmo_password").value == null) {
        formerrors += "Enter Password. <br/>"
      }

      if (formerrors == "" || formerrors == null) {
        document.forms["userLogin"].action = "index.php";
        document.forms["userLogin"].submit();
      } else {
        document.getElementById("errors").innerHTML = formerrors;
        document.getElementById("errors").className="alert alert-danger";
      }

    }
</script>

<?php include("footer.php"); ?>
