<?php
include(realpath(dirname(__FILE__)).'\..\lib\autoload.php');
use controller\admin;

if(session_status()==PHP_SESSION_NONE) session_start();
if(!isset($_SESSION['login']) || $_SESSION['role'] != "admin"){
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
                
                <div style="text-align: center;font-family: initial;"><h3>Admin profile</h3></div>
                
                <div  style="margin-top: 20%;font-family: initial;">
                <ul class="admin-ul">
                    <a href="addfood.php"><li>Add Food Items</li></a>
                    <a href="viewfood.php"><li>View Food Items</li></a>
                    <a href="vieworders.php"><li style="background-color: #f2f2f2;">View Orders</li></a>
                    <a href="ordershistory.php"><li>View Orders History</li></a>
                    <a href="viewusers.php"><li>View Users</li></a>
                </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                <h3 style="text-align: center;margin-bottom: 5%;">View Pending Orders</h3>
                <?php
                    if(isset($_POST['id'])){
                        $check = false;
                        if(isset($_POST['deliverd'])){
                            $check = $op->orderOP->updateOrderStatus($_POST['id'], 2);
                        }else{
                            if(isset($_POST['canceled'])){
                                $check = $op->orderOP->updateOrderStatus($_POST['id'], 3);
                            }
                        }
                        
                        if($check){
                            echo '<div class="alert alert-success" role="alert">
                                Status updated successfuly.
                                </div>';
                        }else{
                            echo '<div class="alert alert-danger" role="alert">
                            Failed to update status.
                            </div>';
                        }
                    }
                ?>
                 <div class="row text-center mt-4">
                     <table class="table table-hover">
  <thead>
    <tr>
        <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody >
      <?php
        $data = $op->orderOP->viewOrders();
        foreach($data as $row){
            echo '
                <tr>
                  <th scope="row"><a href="orderinformation.php?id='.$row["id"].'" style="color: black;text-decoration: underline;">'.$row["id"].'</a></th>
                  <td>'.$row["date"].'</td>
      <td style="width: 40px;padding: 5px;">
        <div class="dropdown">
  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Pending
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <form method="post" action="vieworders.php">
          <input type="hidden" name="id" value="'.$row["id"].'">
          <button class="btn btn-success dropdown-item" name="deliverd" style="background-color: #28a745; color:white;margin-bottom: 7px;">Deliverd</button>
      </form>
      <form method="post" action="vieworders.php">
          <input type="hidden" name="id" value="'.$row["id"].'">
          <button class="btn btn-danger dropdown-item" name="canceled" style="background-color: #dc3545; color:white;">Canceled</button>
      </form>
  </div>
</div>    
    </td>
    </tr>
    '; } 
      ?>
  </tbody>
</table>
                </div>
      
            </div>
        </div>
    </div>
      <?php include("parts/footer.php");?>
  </body>
</html>