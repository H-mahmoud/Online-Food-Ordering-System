<?php
include(realpath(dirname(__FILE__)).'\..\lib\autoload.php');
use controller\guest;
use controller\user;
use controller\admin;

if(session_status()==PHP_SESSION_NONE) session_start();

if(!isset($_SESSION['object']))
    $_SESSION['object'] = new guest();

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
    <?php
        if(isset($_POST['remove']) && isset($_POST['id']) && isset($_SESSION['role']) && $_SESSION['role'] == "user"){
            $check = $op->cartOP->delete($_POST['id']);
            if($check)
                echo '<div class="alert alert-success" style="width:100%; text-align:center;" role="alert">
                    Item removed.
                    </div>';
                            
            else
                echo '<div class="alert alert-danger" style="width:100%; text-align:center;" role="alert">
                    Process failed please try again.
                    </div>';
        }
        else{
            if(isset($_POST['update']) && isset($_POST['id']) && isset($_POST['quantity']) && isset($_SESSION['role']) && $_SESSION['role'] == "user"){
            $check = $op->cartOP->updateQuantity($_POST['id'],$_POST['quantity']);
            if($check)
                echo '<div class="alert alert-success" style="width:100%; text-align:center;" role="alert">
                    Item Updated Successfuly.
                    </div>';
                            
            else
                echo '<div class="alert alert-danger" style="width:100%; text-align:center;" role="alert">
                    Process failed please try again.
                    </div>';
            }
        }
    ?>
      <table class="table">
  <thead style="background-color: #343a40;color: white;">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">MEAL</th>
      <th scope="col">PRICE</th>
      <th scope="col">QUANTITY</th>
      <th scope="col">TOTAL</th>
      <th scope="col">REMOVE</th>
    </tr>
  </thead>
  <tbody>
    <?php
        if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){
            $data = $op->cartOP->view();
            $total = 0;
            $total_price = 0;
            foreach($data as $row){
            $total++;
            $total_price += $row["total_price"];
            echo '
            <tr>
      <th scope="row">#'.$row["id"].'</th>
      <td>'.$row["name"].'</td>
      <td>'.$row["one_price"].'$</td>
        <td><form method="post" action="cart.php"><input type="number" style="width: 60px;" value="'.$row["quantity"].'" name="quantity" min="1" max="100"><button class="btn btn-light" name="update"><i class="fas fa-plus"></i></button><input type = "hidden" value="'.$row["id"].'" name="id"></form></td>
      <td>'.$row["total_price"].'$</td>
        <td><form method="post" action="cart.php"><input type = "hidden" value="'.$row["id"].'" name="id"><button class="btn btn-danger" name="remove">Remove</button></form></td>        
    </tr>
            ';
        }
        }
    ?>

    
  </tbody>
</table>
<hr>
        <hr>
        
        <div class="row" style="padding: 19px;background-color: #f6f6f6;color: black;font-size: 20px;">
            <div class=" col-lg-4 col-md-4 col-sm-12" style="font-family: Impact, Charcoal, sans-serif; color: #343a40;">Meals count: <span><?php if( isset($_SESSION['role']) && $_SESSION['role'] == "user") echo $total;?></span></div>
            <div class=" col-lg-4 col-md-4 col-sm-12" style="font-family: Impact, Charcoal, sans-serif; color: #343a40;">Total price: <span><?php if( isset($_SESSION['role']) && $_SESSION['role'] == "user") echo $total_price;?>$</span></div>
            <div class=" col-lg-4 col-md-4 col-sm-12"><form method="post" action="checkout.php"><button class="btn btn-success" style="width: 100%;" name="checkout" <?php if( !isset($_SESSION['role']) || $_SESSION['role'] != "user") echo "disabled";?>>Check Out</button></form></div>
        </div>

</div>
      <?php include("parts/footer.php");?>
  </body>
</html>