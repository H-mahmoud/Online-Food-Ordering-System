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
    <h2 class="text-center">NEW DISHES</h2>
    <hr>
    <div class="container mt-3">
      <div class="row">
        <div class="col-12">
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleControls" data-slide-to="1"></li>
              <li data-target="#carouselExampleControls" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="images/I1%20(1).jpg" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <a href = "index.php?category=side dishes" style="text-decoration: none;color: white;"><h5>Side Dishes</h5></a>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/I1%20(2).jpg" alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <a href = "index.php?category=side dishes" style="text-decoration: none;color: white;"><h5>Family Meals</h5></a>
                </div>
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="images/I1%20(3).png" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                    <a href = "index.php?category=side dishes" style="text-decoration: none;color: white;"><h5>Lunch</h5></a>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <hr>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-6">
          <div class="row">
            <div class="col-5" style="text-align: right;"><i class="fa fa-truck" style="font-size:30px; text-align: center;"></i></div>
            <div class="col-lg-6 col-10 ml-1">
              <h4>Free Shipping</h4>
            </div>
          </div>
        </div>
        <div class="col-6">
          <div class="row">
            <div class="col-5" style="text-align: right;"><i class="fa fa-dollar" style="font-size:30px"></i></div>
            <div class="col-lg-6 col-10 ml-1">
              <h4>Low Prices</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <h2 class="text-center" id="Menu">OUR MENU</h2>
    <hr>
    <div class="container">
        <?php
            if(isset($_POST['add-to-cart']) && isset($_POST['id'])){
                if(isset($_SESSION['role']) && $_SESSION['role'] == "user"){
                    $check = $op->cartOP->add($_POST['id']);
                    if($check)
                    echo '<div class="alert alert-success" style="width:100%; text-align:center;" role="alert">
                    Item added to your cart.
                    </div>';
                            
                    else
                    echo '<div class="alert alert-danger" style="width:100%; text-align:center;" role="alert">
                    Process failed please try again.
                    </div>';
                }else{
                echo '<div class="alert alert-danger" style="width:100%; text-align:center;" role="alert">
                    You need to create user account to add food to your cart.
                    </div>';
                }
            }
        ?>
        <?php
            $categ = array();
            $data = $op->menuOP->getCategories();
            if($data){
                foreach($data as $cat)
                array_push($categ, $cat["name"]);}
            
            if(isset($_GET['category'])){
                if(in_array($_GET['category'],$categ)){
                    $id = array_search($_GET['category'],$categ) + 1;
                    $menu = $op->menuOP->menuCategory($id);
                }
                else{
                    $menu = array();
                }
                echo "<h4 class='text-center'> ". htmlspecialchars($_GET['category'], ENT_QUOTES)." </h4>";
                
            }
            else{$menu = $op->menuOP->listMenu();}
        ?>
        <div class="row text-center mt-4">
        <?php
            if($menu){
            foreach ($menu as $row){
                echo '
        <div class="col-md-4 pb-1 pb-md-0 mt-4" id ="'.$row["id"].'">
          <div class="card">
            <img class="card-img-top img-responsive center-block" src="products/'.$row["img_path"].'" alt="Card image cap" style = "height: 200px;">
            <div class="card-body">
              <h5 class="card-title">'.$row["name"].'</h5>';
              if(!empty($categ)) echo '<a href = "index.php?category='.$categ[$row["category_id"]-1].'" style="    text-decoration: none;color: gray;"><p class="card-text">'.$categ[$row["category_id"]-1].'. <i class="fa fa-tag fa-rotate-90" aria-hidden="true" style="color: gray;"></i></p></a><hr>';
              echo '<h6 class="card-title">'.$row["price"].'.00$</h6>
              <form method="post" action="index.php"><input type="hidden" value= "'.$row["id"].'" name = "id">
              <button class="btn primary" name="add-to-cart">Add to Cart</button></form>
            </div>
            </div>
            </div>';
            }}
        ?>
        </div>
      </div>
      <?php include("parts/footer.php");?>
    </body>
</html>