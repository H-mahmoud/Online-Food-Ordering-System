<?php
include(realpath(dirname(__FILE__)).'\..\lib\autoload.php');
use controller\guest;

if(session_status()==PHP_SESSION_NONE) session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != "user"){
    header("Location: index.php", true, 301);
    exit();
}

$op = $_SESSION['object'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("parts/head.php");?>
  </head>
  <body>
    <?php include("parts/nav.php");?>
    <div class="container">
            <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12" style="box-shadow: 2px 1px #f2f2f2;">
                <div style="text-align: center;"><img src="images/chefProfile.png" class="img-responsive center-block" style="width: 30%;"></div>
                
                <div style="text-align: center;font-family: initial;"><h3><?php echo $_SESSION['fname']." ".$_SESSION['lname'];?></h3></div>
                
                <div  style="margin-top: 20%;font-family: initial;">
                <ul class="admin-ul">
                    <a href="myorders.php"><li>My Orders</li></a>
                    <a href="myordershistory.php"><li>My Orders History</li></a>
                </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                <h3 style="text-align: center;margin-bottom: 5%;">Statistics</h3>
                <div class="row">
                <div class="card text-white bg-primary mb-3 col-lg-5 col-md-5 col-sm-12" style=" text-align: center;">
                    <div class="card-header">Total orders</div>
                    <div class="card-body">
                    <h5 class="card-title">78 Orders</h5>
                    </div>    
                </div>
                <div class="col-lg-2">    
                </div>
                <div class="card text-white bg-success mb-3 col-lg-5 col-md-5 col-sm-12" style="text-align: center;">
                    <div class="card-header">Delivered Orders</div>
                    <div class="card-body">
                    <h5 class="card-title">60 Orders</h5>
                    </div>    
                </div>
                </div>
                <div class="row">
                <div class="card text-white bg-danger mb-3 col-lg-5 col-md-5 col-sm-12" style="text-align: center;">
                    <div class="card-header">Canceled Orders</div>
                    <div class="card-body">
                    <h5 class="card-title">18 Orders</h5>
                    </div>    
                </div>
                </div>
            </div>
        </div>
    
    </div>          
      <?php include("parts/footer.php");?>
    </body>
</html>