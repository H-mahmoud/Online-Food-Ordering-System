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
                    <a href="vieworders.php"><li>View Orders</li></a>
                    <a href="ordershistory.php"><li>View Orders History</li></a>
                    <a href="viewusers.php"><li style="background-color: #f2f2f2;">View Users</li></a>
                </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                <h3 style="text-align: center;margin-bottom: 5%;">View Users</h3>
                      <table class="table">
  <thead style="background-color: #343a40;color: white;">
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
      <th scope="col">Email</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $users = $op->viewUsers();
      foreach ($users as $user)
          echo '<tr><th scope="row">'.$user['id'].'</th><td>'.$user["first_name"].'</td><td>'.$user["last_name"].'</td><td>'.$user['email'].'</td></tr>';
      ?>
 </tbody>
</table>

            </div>
        </div>
    </div>
    <?php include("parts/footer.php");?>
  </body>
</html>