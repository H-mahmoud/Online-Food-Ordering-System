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
                    <a href="viewfood.php"><li style="background-color: #f2f2f2;">View Food Items</li></a>
                    <a href="vieworders.php"><li>View Orders</li></a>
                    <a href="ordershistory.php"><li>View Orders History</li></a>
                    <a href="viewusers.php"><li>View Users</li></a>
                </ul>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-8 col-md-9 col-sm-8 col-xs-12">
                <h3 style="text-align: center;margin-bottom: 5%;">View Food Items</h3>
                <?php
                    if(isset($_POST['id'])&&isset($_POST['update'])&&isset($_POST['price'])&&isset($_POST['status'])){
                        $check = $op->updateItem($_POST['id'], $_POST['price'], $_POST['status']);
                        
                        if($check){
                            echo '<div class="alert alert-success" style="position:absolute; width:100%;z-index: 2;" role="alert">
                                Updated successfuly.
                                </div>';
                            
                        }else{
                            echo '<div class="alert alert-danger" style="position:absolute; width:100%;z-index: 2;" role="alert">
                            Process failed please try again.
                            </div>';
                        }
                    }
                ?>
                <?php
                if(isset($_POST['delete']) && isset($_POST['id'])){
                    $check = $op->deleteItem($_POST['id']);
                    if($check){
                        echo '<div class="alert alert-success" role="alert">
                                Meal removed successfuly.
                                </div>';
                    }else
                        echo '<div class="alert alert-danger" role="alert">
                            Process failed please try again.
                            </div>';
                        
                }
            ?>
                 <div class="row text-center mt-4">

                     <?php
                     $categ = array();
                     $data = $op->menuOP->getCategories();
                     foreach($data as $cat)
                         array_push($categ, $cat["name"]);
                
                     $menu = $op->getProducts();
                    foreach ($menu as $row){
                        echo '
        <div class="col-md-6 pb-1 pb-md-0 mt-4">
          <div class="card" id="'.$row["id"].'">
            <img class="card-img-top img-responsive center-block" src="products/'.$row["img_path"].'" alt="Card image cap" style = "height: 200px;">
            <div class="card-body">
              <h5 class="card-title">'.$row["name"].'</h5>';
              if(!empty($categ)) echo '<a href = "index.php?category = '.$categ[$row["category_id"]-1].'" style="    text-decoration: none;color: gray;"><p class="card-text">'.$categ[$row["category_id"]-1].'. <i class="fa fa-tag fa-rotate-90" aria-hidden="true" style="color: gray;"></i></p></a><hr>';
              echo'<h6 class="card-title">'.$row["price"].'.00$</h6>
              <div class = "row"><form method="post" class="col-lg-6 col-md-6" action="edit.php"> <input type="hidden" value= "'.$row["id"].'" name = "id">
              <input type="hidden" value= "'.$row["price"].'" name = "price"><input type="hidden" value= "'.$row["name"].'" name = "name"><button class="btn primary" name="edit">Edit</button></form>
                <form method="post" class="col-lg-6 col-md-6"> <input type="hidden" value= "'.$row["id"].'" name = "id"><button class="btn btn-danger" name="delete"> <li class="fa fa-trash"></li></button></form></div>
            </div>
            </div>
            </div>';
                    }
                ?>
                     
                </div>
      
            </div>
        </div>
    </div>
      <?php include("parts/footer.php");?>
  </body>
</html>