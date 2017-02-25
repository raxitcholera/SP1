<?php $page_name="Dashboard"?>
<?php include("head.php"); ?>

<div id="wrapper">
  <!-- Navigation -->
  <?php require 'nav.php';?>
</div>

<div id="page-wrapper">


  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    
  </div>
  <!-- /.row -->

  <div class="row">
    
    <div class="col-lg-8">

      
          <ul class="list-group">
      <?php $portfolios = getAll("pmo_portfolio", array("id" => $_SESSION["pmo_id"]), "portfolio_name", "asc");
      

      foreach($portfolios as $portfolio) { ?>


            <li class="list-group-item">
              <span class="badge">14</span>
              <a href="viewportfolio.php?pid=<?php echo $portfolio["pid"]?>">
                <?php echo $portfolio["portfolio_name"]?>
              </a>
            </li>
         
            
        
      <?php } ?>
       </ul>
     
    </div>

    <div class="col-lg-4">
      <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-money fa-fw"></i> Recent Transactions
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="list-group">
                <a href="#" class="list-group-item">
                    <i class="fa fa-plus fa-fw text-success"></i> Alphabet Inc.
                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-minus fa-fw text-danger"></i> Yahoo Inc.
                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-minus fa-fw text-danger"></i> COMSCORE INC COM...
                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-plus fa-fw text-success"></i> Pope Resources
                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-plus fa-fw text-success"></i> JP Morgan
                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-minus fa-fw text-danger"></i> IBM
                    <span class="pull-right text-muted small"><em>11:13 AM</em>
                    </span>
                </a>
                <a href="#" class="list-group-item">
                    <i class="fa fa-plus fa-fw text-success"></i> Microsoft Corporation
                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                    </span>
                </a>
                
            </div>
            <!-- /.list-group -->
            <a href="#" class="btn btn-default btn-block">View All Transactions</a>
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    
  </div>

      
    </div><!-- /#page-wrapper -->
    <?php include("footer.php"); ?>