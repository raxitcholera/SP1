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
        <a class="btn btn-success">Buy Stocks</a> 
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
              <th class="text-right">Gain</th>
              <th class="text-right">Gain %</th>
            </tr>
          </thead>
          <tbody>
            <?php for($i= 0; $i < 5; $i++) { ?>
            <tr>
              <td>
                Yahoo! Inc
              </td>
              <td>
                YHOO
              </td>
              <td class="text-right">
                45.55
              </td>
              <td class="text-right">
                +0.14(0.31%)
              </td>
              <td class="text-right">
                150.00
              </td>
              <td class="text-right">
                6,416.50
              </td>
              <td class="text-right">
                6,832.50
              </td>
              <td class="text-right">
                +416.00
              </td>
              <td class="text-right">
                +6.48%
              </td>
              
              
            </tr>
            <?php } ?>

            <!-- Cash -->
            <tr>
              <td>
                Cash
              </td>
              <td>
                
              </td>
              <td class="text-right">
                $13,583.50
              </td>
              <td class="text-right">
                
              </td>
              <td class="text-right">
                
              </td>
              <td class="text-right">
                
              </td>
              <td class="text-right">
                $13,583.50
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
                +21(0.10%)
              </td>
              <td class="text-right">
                
              </td>
              <td class="text-right">
                $6,416.50
              </td>
              <td class="text-right">
                $20,416.00
              </td>
              <td class="text-right">
                +$416.00
              </td>
              <td class="text-right">
                +6.48%
              </td>
              
              
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>

    
  </div>

      
    </div><!-- /#page-wrapper -->
    <?php include("footer.php"); ?>
