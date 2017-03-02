<?php $page_name="Buy Stocks"?>
<?php require 'head.php';?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <?php 
        $form = checkFormParams(array("ticker", "tx_qty", "pid"));
        if($form["cnt"] == 3){
          // Get Ticker Details
          $stock = getById("pmo_stocklist", "tid", $form["ticker"]);
          

          // Check if stocks exists in current portfolio
          $status = getByTwoIds("pmo_stock", "pid", $form["pid"], "ticker", $stock["ticker"]);           
          
          // If Stock exists in portfolio
          if(isset($status)){
            //Find Current Rate:
            $stockprice = currentStockPrice($stock["ticker"], $stock["exchange"]);
            $stockprice = str_replace(",", "", $stockprice);
            if(!isset($stockprice)){
              $error = "Could not retrieve stock price";
              $query_params["pid"] = $form["pid"];
            } else {
              $cashRequired = floatval($stockprice["l"]) * intval($form["tx_qty"]);
              if($stock["exchange"] == "NSE"){
                $currency = "INR";
                $exchangeRate = currentExchange("INRUSD");
              } else {
                $currency = "USD";
                $exchangeRate = 1;
              }
              
              $cashRequiredUSD = $cashRequired * $exchangeRate;

              $currentBalance = getById("pmo_portfolio", "pid", $form["pid"])["portfolio_cash"];  
                
              if($currentBalance < $cashRequiredUSD){
                $error = "Insufficient Cash";  
                $query_params["pid"] = $form["pid"];
              } else {
                // Add cash transaction for buy
                insertFields("pmo_cash", array("pid" => $form["pid"], "cash_date" => currentDate(), "cash_amount"=> $cashRequiredUSD, "cash_action" => "buy"));

                // Add stock transaction
                insertFields("pmo_stock_tx", array("sid" => $status["sid"], "tx_date" => currentDate(), "tx_price"=> $stockprice["l"], tx_qty => $form["tx_qty"],  "tx_amount" => $cashRequired, "action" => "buy", "tx_currency" => $currency, "tx_exchangerate" => $exchangeRate, "tx_usdamount" => $cashRequiredUSD));
                
                $costBasis = floatval($cashRequired) + floatval($status["costbasis"]);
                $costBasisUSD = floatval($cashRequiredUSD) + floatval($status["costbasisusd"]);
                $updatedQty = floatval($form["tx_qty"]) + floatval($status["qty"]);
                $updatedCash = $currentBalance - $cashRequiredUSD;

                // Update Cost Basis in pmo_stock
                updateById("pmo_stock", "sid", $status["sid"], array("qty" => $updatedQty, "costbasis" => $costBasis, "costbasisusd" => $costBasisUSD));
                
                // Update portfolio cash balance
                updateById("pmo_portfolio", "pid", $form["pid"], array("portfolio_cash" => $updatedCash));

                // Redirect back to view portfolio
                redirectTo("viewportfolio.php?pid=". $form["pid"]);
              }
            }
          } else { // Stock Does not exist in the portfolio
            //Find Historical Rate for 17-jan-2017:
            $stockprice = historicalStockPrice($stock["ticker"], $stock["exchange"], "2017-01-17", "2017-01-17");
            $stockprice = str_replace(",", "", $stockprice);
            if(!isset($stockprice)){
              $error = "Could not retrieve historical stock price";
              $query_params["pid"] = $form["pid"];
            } else {
              if($stock["exchange"] == "NSE"){
                $currency = "INR";
                $exchangeRate = 0.014725;
              } else {
                $currency = "USD";
                $exchangeRate = 1;
              }

              $cashRequired = floatval($stockprice[0]["Adj_Close"]) * intval($form["tx_qty"]);
              $cashRequiredUSD = $cashRequired * $exchangeRate;
              $currentBalance = getById("pmo_portfolio", "pid", $form["pid"])["portfolio_cash"];  
                
              if($currentBalance < $cashRequiredUSD){
                $error = "Insufficient Cash";  
                $query_params["pid"] = $form["pid"];
              } else {
                $updatedCash = $currentBalance - $cashRequiredUSD;

                // Add cash transaction for buy
                insertFields("pmo_cash", array("pid" => $form["pid"], "cash_date" => currentDate(), "cash_amount"=> $cashRequiredUSD, "cash_action" => "buy"));

                // Add stock to portfolio
                $newid = insertFields("pmo_stock", array("pid" => $form["pid"], "ticker" => $stock["ticker"], "stockname" => $stock["companyname"], "qty" => $form["tx_qty"], "costbasis" => $cashRequired, "costbasisusd" => $cashRequiredUSD));
                
                // Add stock transaction
                insertFields("pmo_stock_tx", array("sid" => $newid , "tx_date" => currentDate(), "tx_price"=> $stockprice[0]["Adj_Close"], tx_qty => $form["tx_qty"], "tx_amount" => $cashRequired, "action" => "buy", "tx_currency" => $currency, "tx_exchangerate" => $exchangeRate, "tx_usdamount" => $cashRequiredUSD));

                
                
                // Update portfolio cash
                updateById("pmo_portfolio", "pid", $form["pid"], array("portfolio_cash" => $updatedCash));

                // Redirect back to view portfolio
                redirectTo("viewportfolio.php?pid=". $form["pid"]);
              }
            }
          }

        } else {
          $query_params = checkQueryParams(array("pid"));
        }
      ?>

      <h2 class="page-header">Buy Stocks</h2>
      
      <form role="form" id="addPortfolio" method="POST">
        <div id="errors"></div>
        <?php 
        if(isset($error)){ ?>
          <div class="alert alert-danger alert-dissmisible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?php echo $error; ?>
          </div>
        <?php } ?>
        <div class="form-group">
            <?php $tickers = getAll("pmo_stocklist", null, "ticker", "asc");?>
            <label>Stock Ticker</label>
            <select class="form-control" name="ticker" id="ticker">
              <option value="0">Select</option>
              <?php foreach($tickers as $ticker){ ?>
                <option value="<?php echo $ticker["tid"]?>"><?php echo $ticker["ticker"]?>(<?php echo $ticker["exchange"]?>) : <?php echo $ticker["companyname"]?> </option>
              <?php } ?>
            </select>
            

        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input id="tx_qty" name="tx_qty" class="form-control">
        </div>
        <input id="pid" name="pid" type="hidden" value="<?php echo $query_params["pid"]?>">
        
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

      if(document.getElementById("ticker").value == 0) {
        formerrors += "Select Stock. <br/>"
      }

      if(document.getElementById("tx_qty").value == "" || document.getElementById("tx_qty").value == null || document.getElementById("tx_qty").value == 0) {
        formerrors += "Enter correct quantity <br/>"
      }

      if (formerrors == "" || formerrors == null) {
        document.forms["addPortfolio"].action = "buystocks.php";
        document.forms["addPortfolio"].submit();
      } else {
        document.getElementById("errors").innerHTML = formerrors;
        document.getElementById("errors").className="alert alert-danger";
      }

    }

</script>

<?php include("footer.php"); ?>
