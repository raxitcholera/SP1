<?php $page_name="Add Portfolio"?>
<?php require 'head.php';?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <?php 
        $form = checkFormParams(array("portfolio_name"));
        if($form["cnt"] == 1){
          // echo "Post";
          $result = getByTwoIds("pmo_portfolio", "portfolio_name", $form["portfolio_name"], "id", $_SESSION["pmo_id"]);
          if(isset($result)){
            $error = "duplicate";
          } else {
            // Save Portfolio in Database
            $id = insertFields("pmo_portfolio", 
                array("portfolio_name" => $form["portfolio_name"], 
                      "id" => $_SESSION["pmo_id"], 
                      "created_dt" => currentDate()));
            redirectTo("myhome.php");
          }
        } else {
          $error = "";  
        }
      ?>
      <h2 class="page-header">Add Portfolio</h2>
      
      <form role="form" id="addPortfolio" method="POST">
        <div id="errors"></div>
        <?php 
        if($error == "duplicate"){ ?>
          <div class="alert alert-danger alert-dissmisible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Duplicate Portfolio Name: <?php echo $form["portfolio_name"]?>
          </div>
        <?php } ?>

        <div class="form-group">
            <label>Portfolio Name</label>
            <input id="portfolio_name" name="portfolio_name" class="form-control">
        </div>
        
        <a href="javascript:submitForm();" class="btn btn-primary">Save</a>
        <a href="myhome.php" class="btn btn-default">Cancel</a>
      </form>
    </div>
    
  </div>
  <!-- /.row -->
</div><!-- /#page-wrapper -->


<script type="text/javascript">
  
  function submitForm(){
      var formerrors = "";    

      if(document.getElementById("portfolio_name").value == "" || document.getElementById("portfolio_name").value == null) {
        formerrors += "Enter Portfolio Name. <br/>"
      }

      if (formerrors == "" || formerrors == null) {
        document.forms["addPortfolio"].action = "addportfolio.php";
        document.forms["addPortfolio"].submit();
      } else {
        document.getElementById("errors").innerHTML = formerrors;
        document.getElementById("errors").className="alert alert-danger";
      }

    }

</script>

<?php include("footer.php"); ?>
