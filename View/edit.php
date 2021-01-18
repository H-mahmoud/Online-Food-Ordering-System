<?php
include(realpath(dirname(__FILE__)).'\..\lib\autoload.php');
use controller\guest;

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
                    <a href="viewfood.php"><li style="background-color: #f2f2f2;">View Food Items</li></a>
                    <a href="vieworders.php"><li>View Orders</li></a>
                    <a href="ordershistory.php"><li>View Orders History</li></a>
                    <a href="viewusers.php"><li>View Users</li></a>
                </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                <?php
                    if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['price'])){
                        $id = (int)$_POST['id'];
                        $name= htmlspecialchars($_POST['name'], ENT_QUOTES);
                        $price = (int)$_POST['price'];
                    }else{
                        $id = 0;
                        $name= "Unknown";
                        $price = 0;
                    }
                ?>
                <h3 style="text-align: center;margin-bottom: 5%;">Update Food Details</h3><hr>

                <h5><?php echo $name;?></h5>
                <form method="post" action="viewfood.php#<?php echo $id; ?>">
                <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 0px; margin: 0px">
                    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
  <input type="double" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="<?php echo $price.".00$"; ?>" required name="price">
  <div class="input-group-append">
    <span class="input-group-text">.00</span>
  </div>
</div>
                </div>
                </div>
                    <div class="row" style="margin-top: 5%;">
                        <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Options</label>
  </div>
  <select class="custom-select" name="status">
    <option selected required>Status</option>
      <option value="1">Enable.</option>
      <option value="0">Disable.</option>
  </select>
</div>
                    </div>
                    <input type="hidden" value= "<?php echo $id; ?>" name = "id">
                 <div class="row" style="margin-top: 5%;">
                     <div class="col-lg-6 col-md-6">
                        <input type="submit" class="btn btn-success" style="width: 100%;" value="Update" name="update">
                     </div>
                     <div class="col-lg-6 col-md-6">
                         <a href="viewfood.php#<?php echo $id; ?>" class="btn btn-danger" style="width: 100%;"> Cancel</a>
                     </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php include("parts/footer.php");?>
  </body>
</html>