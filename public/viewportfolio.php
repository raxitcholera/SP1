<?php $page_name="Dashboard"?>
<?php include("head.php"); ?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">

<?php 
$query_params = checkQueryParams(array("pid"));
if($query_params["cnt"] == 1 && isset($query_params["pid"])){
  $portfolio = getById("pmo_portfolio", "pid", $query_params["pid"]);
} else {
  redirectTo("myhome.php");
}
?>

  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><?php echo $portfolio["portfolio_name"] ?></h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="btn-group" role="group" aria-label="cashtx">
        <a href="buystocks.php?pid=<?php echo $portfolio["pid"] ?>" class="btn btn-success">Buy Stocks</a> 
        <a class="btn btn-success">Sell Stocks</a> 
        <a href="addcash.php?pid=<?php echo $portfolio["pid"] ?>" class="btn btn-primary">Add Cash</a> 
        <a href="withdrawcash.php?pid=<?php echo $portfolio["pid"] ?>" class="btn btn-primary">Withdraw Cash</a>
        <a class="btn btn-info ">Delete Portoflio</a>    
      </div>
      <h3>Cash Balance:  $ <?php echo $portfolio["portfolio_cash"]?></h3>
    </div>
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-lg-12">
      <div class="dataTable_wrapper">
        <table class="table table-hover" id="sectionTable1">
          <thead>
            <tr>
              <th>Name</th>
              <th>Symbol</th>
              <th class="text-right">Last price</th>
              <th class="text-right">Change</th>
              <th class="text-right">Shares</th>
              <th class="text-right">Cost basis</th>
              <th class="text-right">Mkt value</th>
              <th class="text-right">Cost basis (USD)</th>
              <th class="text-right">Mkt value (USD)</th>
              <th class="text-right">Gain</th>
              <th class="text-right">Gain %</th>
              
            </tr>
          </thead>
          <tbody>
            <?php 
              $totalCostBasis = 0;
              $totalMV = 0;
              $totalGain = 0;
              $totalQty = 0;

              $stocks = getAll("pmo_stock", array("pid" => $query_params["pid"]), "ticker", "asc");
             
             ?>
            <?php foreach($stocks as $stock) { ?>
            <?php
             $exchange = getById("pmo_stocklist", "ticker", $stock["ticker"])["exchange"];
              if($exchange == "NSE"){
                $currency = "&#8377; ";
                $currencyRate = currentExchange("INRUSD");
              } else {
                $currency = "$ ";
                $currencyRate = 1;
              }
            ?>
            <tr>
              <td>
                <?php echo $stock["stockname"]?>
              </td>
              <td>
                <?php echo $stock["ticker"]?>
              </td>
              <td class="text-right">
                <?php
                  $price = currentStockPrice($stock["ticker"], $exchange);
                  $price = str_replace(",", "", $price);
                  echo $currency . $price["l"]; 
                ?>
              </td>
              <td class="text-right">
                <?php echo $price["c"]?> (<?php echo $price["cp"]?>%)
              </td>
              <td class="text-right">
                <?php 
                  echo number_format($stock["qty"], 2);
                  $totalQty += intval($stock["qty"]);
                ?>

              </td>
              <td class="text-right">
                <?php
                  echo $currency . number_format($stock["costbasis"], 2);
                  // $totalCostBasis += floatval($stock["costbasis"]);
                ?>
              </td>
              <td class="text-right">
                <?php 
                  $mv = floatval($stock["qty"] * $price["l"]);
                  // $totalMV += floatval($mv);
                  echo $currency . number_format($mv, 2);
                ?>
              </td>

              <td class="text-right">
                <?php
                  echo "$ " . number_format($stock["costbasisusd"], 2);
                  $totalCostBasis += floatval($stock["costbasisusd"]);
                ?>
              </td>
              <td class="text-right">
                <?php 
                  
                  $mvd = $mv * $currencyRate;
                  $totalMV += floatval($mvd);
                  echo "$ " . number_format($mvd, 2);
                ?>
              </td>
              

              <td class="text-right">
                <?php 
                  $gain = floatval($mvd - $stock["costbasisusd"]);
                  $totalGain += floatval($gain);
                  echo "$ " . number_format($gain, 2);
                ?>
              </td>
              <td class="text-right">
                <?php 
                  echo number_format(($gain / $stock["costbasisusd"])*100, 2);
                ?>%
              </td>
              
              
            </tr>
            <?php } ?>

            <?php if($totalQty > 0){ ?>
              <!-- Cash -->
              <tr class="warning">
                <td>
                  Cash
                </td>
                <td>
                  
                </td>
                <td class="text-right">
                  $<?php echo number_format($portfolio["portfolio_cash"], 2)?>
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  $ <?php 
                    echo number_format($portfolio["portfolio_cash"], 2);
                    $totalMV += floatval($portfolio["portfolio_cash"]);
                  ?>
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  
                </td>
                
                
              </tr>

            
              <!-- Total -->
              <tr class="info">
                <td>
                  Portfolio Value
                </td>
                <td>
                  
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  <?php echo number_format($totalQty, 2);?>
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  
                </td>
                <td class="text-right">
                  <?php echo "$ " . number_format($totalCostBasis, 2);?>
                </td>
                <td class="text-right">
                  <?php echo "$ " . number_format($totalMV, 2);?>
                </td>
                <td class="text-right">
                  <?php echo "$ " . number_format($totalGain, 2);?>
                </td>
                <td class="text-right">
                  <?php 
                    if($totalCostBasis > 0){
                      echo number_format(floatval(($totalGain / $totalCostBasis)*100), 2);  
                    }
                  ?>%
                </td>
                
                
                
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>

    
  </div>

      
    </div><!-- /#page-wrapper -->
    <?php include("footer.php"); ?>
