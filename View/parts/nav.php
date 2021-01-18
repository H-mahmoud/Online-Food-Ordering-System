    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php" style="font-weight: bold;">Food Delivery</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php#Menu">Menu</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="index.php?category=breakfast">Breakfast</a>
          <a class="dropdown-item" href="index.php?category=lunch">Lunch</a>
            <a class="dropdown-item" href="index.php?category=dinner">Dinner</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="index.php?category=side dishes">Side Dishes</a>
        </div>
      </li>
            
              <li class="nav-item">
              <a class="nav-link" href="#">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
		  
            <a href="cart.php"><button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 15px">Cart
		    <i class="fas fa-shopping-cart"></i>
          </button></a>
        <?php
            if(isset($_POST['logout'])){
                $op->logout();
                header("Location: index.php", true, 301);
            }
            
            if(isset($_SESSION['login'])){
                if($_SESSION['role'] == "user")
                    echo '<a href="user.php"><button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 15px">
                    <i class="far fa-user"></i>
                    </button></a>';
                else{
                    if($_SESSION['role'] == "admin")
                    echo '<a href="admin.php"><button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-right: 15px">
                    <i class="far fa-user"></i>
                    </button></a>';
                }
                
                echo '<form method = "post" style = "margin: 0px;"><button class="btn btn-outline-danger my-2 my-sm-0" name = "logout" type="submit">Logout <i class="fas fa-door-open"></i></button></form>';
            } else{
                echo '<a href="login.php"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button></a>';
            }   
        ?>
          
        </div>
      </div>
    </nav>
	<hr>