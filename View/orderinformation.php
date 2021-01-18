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
                    <a href="viewusers.php"><li>View Users</li></a>
                </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                <h3 style="text-align: center;margin-bottom: 5%;">Order Information</h3>
                <hr>
                <?php
                    if(isset($_GET['id'])){
                        $information = $op->orderOP->deliveryInformation($_GET['id']);
                        if($information != -1){
                                $package = $information['package'];
                                $agent = $information['delivery'];
                            
                            
                    
                ?>
                 <div class="row text-center mt-4">
                     <div class="col-lg-6 col-md-6">
                         <h4>Package details</h4>
                         <br>
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
                                $total = 0;
                                foreach ($package as $row){
                                    echo '   
                                            <tr>
                                              <th scope="row">'.$row['product_id'].'</th>
                                              <td>'.$row['name'].'</td>
                                              <td>'.$row['quantity'].'</td>
                                            </tr>
                                       ';
                                        $total++;
                                }
                                
                              ?>
                          </tbody>
                        </table>
                     </div>
                     <div class="col-lg-1 col-md-1" style="box-shadow: 2px 1px #f2f2f2;"></div>
                     <div class="col-lg-5 col-md-5">
                        <h4>Agent details</h4>
                         <br>
                          <table class="table">
                              <tbody>
                                  <tr>
                                      <th scope="row">Name</th>
                                      <td><?php echo $agent['agent_name']; ?></td>
                                  </tr>
                                  <tr>
                                      <th scope="row">Phone</th>
                                      <td><?php echo $agent['phone_number']; ?></td>
                                  </tr>
                                  <tr>
                                      <th scope="row">Address</th>
                                      <td><?php echo $agent['adress']; ?></td>
                                  </tr>
                              </tbody>
                         </table>
                         <br>
                         <div class="row" style="text-align:center;font-family: Impact, Charcoal, sans-serif;"><div class="col-lg-6 col-md06 col-sm-6 col-xm-6">Meals count <?php echo $total; ?></div>
                        <div class="col-lg-6 col-md06 col-sm-6 col-xm-6">Total price <?php echo $agent['total_price']; ?>$</div>
                         </div>
                        
                         <br>
                         <?php 
                            if($agent["status_id"] == 1){
                         ?>
                         <div class="row" style="text-align:center;margin:0px;">
                            <div class="dropdown" style="width:100%;">
  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:100%;">
    Pending
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width:100%;text-align:center;">
      <form method="post" action="vieworders.php">
          <input type="hidden" name="id" value="<?php echo $agent["id"]; ?>">
          <button class="btn btn-success dropdown-item" name="deliverd" style="background-color: #28a745; color:white;margin-bottom: 7px;">Deliverd</button>
      </form>
      <form method="post" action="vieworders.php">
          <input type="hidden" name="id" value="<?php echo $agent["id"]; ?>">
          <button class="btn btn-danger dropdown-item" name="canceled" style="background-color: #dc3545; color:white;">Canceled</button>
      </form>
  </div>
</div>  
                         </div>
                         <?php
                            }else{
                                if($agent["status_id"] == 2)
                                    echo'
                                        <button class="btn btn-success" name="deliverd" style="width:100%;">Deliverd</button>
                                    ';
                                else
                                    echo'
                                        <button class="btn btn-danger" name="canceled" style="width:100%;">Canceled</button>
                                    ';
                            }
                         ?>
                     </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
      <?php include("parts/footer.php");?>
  </body>
</html>