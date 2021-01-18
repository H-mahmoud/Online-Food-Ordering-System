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
                    <a href="myordershistory.php"><li style="background-color: #f2f2f2;">My Orders History</li></a>
                </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
           <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                <h3 style="text-align: center;margin-bottom: 5%;">Orders history</h3>
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
        $data = $op->orderOP->viewOrdersHistory();
        
        foreach($data as $row){
            echo '
                <tr>
                  <th scope="row"><a href="userorderinformation.php?id='.$row["id"].'" style="color: black;text-decoration: underline;">'.$row["id"].'</a></th>
                  <td>'.$row["date"].'</td>
                  <td style="width: 40px;padding: 5px;">
                  ';
            if($row["status_id"] == 2)
                echo'
                    <button class="btn btn-success" name="deliverd" style="width:90.53px;">Deliverd</button>
                ';
            else
                echo'
                    <button class="btn btn-danger" name="canceled" style="width:90.53px;">Canceled</button>
                ';
            echo'
                    </td>
                </tr>';
            
        }
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