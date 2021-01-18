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
                    <a href="addfood.php"><li style="background-color: #f2f2f2;">Add Food Items</li></a>
                    <a href="viewfood.php"><li>View Food Items</li></a>
                    <a href="vieworders.php"><li>View Orders</li></a>
                    <a href="ordershistory.php"><li>View Orders History</li></a>
                    <a href="viewusers.php"><li>View Users</li></a>
                </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                <h3 style="text-align: center;margin-bottom: 5%;">Add Food Items</h3>
                <form method="post" enctype="multipart/form-data">
                <?php
                    if(isset($_POST['meal']) && isset($_POST['price']) && isset($_POST['category'])){
                        $check = $op->addItem($_POST['meal'], $_POST['price'], $_POST['category'], $_FILES['upload']);
                        
                        if($check){
                            echo '<div class="alert alert-success" role="alert">
                                New meal added successfuly.
                                </div>';
                        }else{
                            echo '<div class="alert alert-danger" role="alert">
                            Process failed please try again.
                            </div>';
                        }
                    }    
                ?>
                <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12" style="padding: 0px; margin: 0px">
                    <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" >Name</span>
  </div>
  <input type="text" class="form-control" name="meal" placeholder="meal name" required>
</div>  
                </div>
                
                <div class="col-lg-2">    
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12" style="padding: 0px; margin: 0px">
                    <div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text">$</span>
  </div>
  <input type="double" class="form-control" aria-label="Amount (to the nearest dollar)" placeholder="Price" required name="price">
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
  <select class="custom-select" name="category">
    <option selected required>Categories</option>
      <?php
        $data = $op->menuOP->getCategories();
        foreach($data as $cat)
            echo '<option value="'.$cat["id"].'">'.$cat["name"].'</option>';
      ?>
  </select>
</div>
                    </div>
                    <div class="row" style="margin-top: 5%;">
                <div class="input-group">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
  </div>
  <div class="custom-file">
  <input type="file" name="upload" id="upload" accept="image/*" title="Choose Your Image" class="custom-file-input" required/>
    <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
  </div>
</div></div>
                <div class="row" style="margin-top: 5%;">
                    <input type="submit" class="btn btn-success" style="width: 100%;" value="Add new meal">
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php include("parts/footer.php");?>
  </body>
</html>