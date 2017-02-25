<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    
        <div class="navbar-header">
            
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
            <a class="navbar-brand" href="myhome.php"><img src="img/productlogosm.png" alt=""></a>
        </div>
        
        
        <ul class="nav navbar-top-links navbar-right">
            <?php if(isLoggedIn()){ ?>
            <li>
                <h5><?php echo $_SESSION["pmo_fname"]?>, <?php echo $_SESSION["pmo_lname"]?> (<?php echo $_SESSION["pmo_username"]?>)</h5>
            </li>
            
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    
                    <li><a href="signout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>   
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
            <?php } ?>
        </ul>
        
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
            <?php if(isLoggedIn()){ ?>
                
                <li>
                    <a href="myhome.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                
                <li>
                    <a href="addportfolio.php"><i class="fa fa-plus-circle"></i> Add Portfolio</a>
                </li>

                
                <?php } else { ?>
                    <li>
                        <a href="index.php"><i class="fa fa-unlock"></i> Login</a>
                    </li>
                    <li>
                        <a href="register.php"><i class="fa fa-asterisk"></i> Register</a>
                    </li>    
                <?php } ?>                
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
        
    </div>
    <!-- /.navbar-static-side -->
</nav>
