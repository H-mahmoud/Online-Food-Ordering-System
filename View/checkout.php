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
            <div class="col-lg-7 col-md-7 col-sm-12">
                <h3>Delivery Information</h3>
                <hr>
            <form action="confirmation.php" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Agent Name</label>
                    <input type="text" class="form-control"  placeholder="Full name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Home Address</label>
                    <input type="text" class="form-control" placeholder="Home Address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Phone Number</label>
                    <input type="tel" class="form-control" placeholder="01111111111" maxlength="11" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Payment Options</label>
                    <div class="input-group mb-3">     
  <select class="custom-select" id="inputGroupSelect01" name="payment" required>
    <option selected>Choose...</option>
    <option value="1">Chash payment</option>
  </select>
</div>
                </div>
                
                    <button class="btn btn-success" style="margin-top: 20px;width: 50%;" name="confirmation">Confirm my order</button>
            </form>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-12"></div>
            <div class="col-lg-4 col-md-4 col-sm-12" style="border-top: 20px solid #28a745;padding-left: 30px;padding-top: 20px;box-shadow: 1px 1px 1px 1px #bbbab8;word-wrap: break-word;">
                <h5 style="font-weight: bold;">Order details</h5>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Quantity</th>
                       </tr>
                    </thead>
                    <tbody>
                <?php 
                    $cart = $op->cartOP->checkOut();
                    $total = 0;
                    while($total < count($cart['id'])){
                        echo '   
                            <tr>
                              <th scope="row">'.$cart['id'][$total].'</th>
                              <td>'.$cart['name'][$total].'</td>
                              <td>'.$cart['quantity'][$total].'</td>
                            </tr>
                       ';
                        $total++;
                    }
                ?>
                </tbody>
                </table>
                <br>
                <div class="row" style="text-align:center;font-family: Impact, Charcoal, sans-serif;  color: #343a40;"><div class="col-lg-6 col-md06 col-sm-6 col-xm-6">Meals count <?php echo $total; ?></div>
                <div class="col-lg-6 col-md06 col-sm-6 col-xm-6">Total price <?php echo $cart['total_price']; ?></div>
                </div>
            </div>
        </div>
      </div>
      <?php include("parts/footer.php");?>
  </body>
</html>