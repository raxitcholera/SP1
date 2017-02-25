<?php $page_name="Withdraw Cash"?>
<?php require 'head.php';?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <?php 
        
        $form = checkFormParams(array("pid", "cash_amount"));
        if($form["cnt"] == 2){
          $currentBalance = getById("pmo_portfolio", "pid", $form["pid"])["portfolio_cash"];
          
          if(floatval($currentBalance) >= floatval($form["cash_amount"])){
            withdrawCash($form["pid"], currentDate(), $form["cash_amount"], "withdraw");  
            redirectTo("viewportfolio.php?pid=". $form["pid"]);  
          } else {
            $error = "negative";
            $query_params["pid"] = $form["pid"];
          }
        } else {
          $error = "";
          $query_params = checkQueryParams(array("pid"));
        }
        
        if(!isset($query_params["pid"])){
          redirectTo("myhome.php");  
        }
      ?>
      <h2 class="page-header">Withdraw Cash</h2>
      
      <form role="form" id="addPortfolio" method="POST">
        <div id="errors"></div>
        <?php 
        if($error == "negative"){ ?>
          <div class="alert alert-danger alert-dissmisible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Not enough balance in the portfolio {<?php echo $currentBalance; ?>} 
          </div>
        <?php } ?>

        <div class="form-group">
            <label>Amount</label>
            <input id="cash_amount" name="cash_amount" class="form-control">
            <input id="pid" name="pid" type="hidden" value="<?php echo $query_params["pid"]?>">
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

      if(document.getElementById("cash_amount").value == "" || document.getElementById("cash_amount").value == null) {
        formerrors += "Enter Cash Amount. <br/>"
      }

      if (formerrors == "" || formerrors == null) {
        document.forms["addPortfolio"].action = "withdrawcash.php";
        document.forms["addPortfolio"].submit();
      } else {
        document.getElementById("errors").innerHTML = formerrors;
        document.getElementById("errors").className="alert alert-danger";
      }

    }

</script>

<?php include("footer.php"); ?>
