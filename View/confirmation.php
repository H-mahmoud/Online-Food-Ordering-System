<?php
include(realpath(dirname(__FILE__)).'\..\lib\autoload.php');
use controller\guest;
use controller\user;
use controller\admin;

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
    <div class="container" style="padding-top:20px;padding-bottom:20px;">
        <div class="row">
            <div class="col-lg-4 col-md-4"></div>
                <div class="col-lg-4 col-md-4" style="text-align:center;">
            <?php
                $cart = $op->cartOP->checkOut();
                if(isset($_POST['confirmation']) && isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['address']) && $cart['total_price'] > 0 ){
                    $confirm = $op->orderOP->placeOrder($_POST['name'], $_POST['address'], $_POST['phone'], $cart['id'], $cart['total_price'], $cart['quantity'] );
                    
                    if($confirm){
                       echo '
                        <h4 style="margin-bottom:20px;">Your order is confirmed</h4>
                        <img src="images/success.png" style="width: 200px; margin-bottom:20px;">
                        <h4 style="margin-bottom:20px;">Order #'.$confirm.'</h4>
                        ';
                        $op->cartOP->clear();
                    }else{
                        echo '
                        <h4 style="margin-bottom:20px;">Failed to confirm your order, try again </h4>
                        <img src="images/fail.png" style="width: 200px; margin-bottom:20px;">
                        ';
                        
                    }
                    
                }
            ?>
            </div>
            <div class="col-lg-4 col-md-4"></div>
        </div>
        
    </div>
    <?php include("parts/footer.php");?>
  </body>
</html>