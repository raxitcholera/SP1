<?php $page_name="Test Functions"?>
<?php require 'head.php';?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">
  <div class="row">
    
       <?php
          $stock = currentStockPrice("AMBUJACEM", "NSE");
          var_dump($stock); 

          $stockhistory = historicalStockPrice("TCS", "NSE", "2017-01-17", "2017-01-17");
          var_dump($stockhistory); 

          $currency = currentExchange("INRUSD");
          echo $currency;

       ?>
  </div>
  <!-- /.row -->
</div><!-- /#page-wrapper -->

<?php include("footer.php"); ?>
