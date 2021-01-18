<?php
include(realpath(dirname(__FILE__)).'\..\lib\autoload.php');
use controller\guest;
use controller\user;
use controller\admin;

if(session_status()==PHP_SESSION_NONE) session_start();
if(isset($_SESSION['login'])){
    header("Location: index.php", true, 301);
    exit();
}

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
    <div class="container" style="text-align: center;">    
        <div class="raw">
        <div style="margin-top: 50px;margin-left: 25%;" class="col-lg-6 col-md-6 col-sm-8">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <img src="images/chefProfile.png" style="width: 20%;">
                        <div class="panel-title" style="font-size: 20px;font-weight: bold;">Sign In</div>
                    </div>
                    <div style="padding-top:20px" class="panel-body" >
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post" action="login.php">
                            <?php
                                if(isset($_POST['Email']) && isset($_POST['Password'])){
                                    $data = $op->login($_POST['Email'], $_POST['Password']);
                                    $check;
                                    foreach($data as $c )
                                        $check = $c;
                                    if($check){
                                        if($check['role_id'] == 1){
                                            $_SESSION['id'] = $check['id'];
                                            $_SESSION['fname'] = $check['first_name'];
                                            $_SESSION['lname'] = $check['last_name'];
                                            $_SESSION['email'] =  $check['email'];
                                            $_SESSION['role'] = "admin";
                                            $_SESSION['login'] = true;
                                            $_SESSION['object'] = new admin();
                                            header("Location: admin.php");
                                            exit();
                                        }else{
                                            if($check['role_id'] == 2){
                                                $_SESSION['id'] = $check['id'];
                                                $_SESSION['fname'] = $check['first_name'];
                                                $_SESSION['lname'] = $check['last_name'];
                                                $_SESSION['email'] =  $check['email'];
                                                $_SESSION['role'] = "user";
                                                $_SESSION['login'] = true;
                                                $_SESSION['object'] = new user();
                                                header("Location: user.php");
                                                exit();
                                            }
                                        }
                                                
                                    }
                                    else
                                        echo '<div class="alert alert-danger" role="alert">
                                        Wrong email or password.
                                        </div>';
                                }
                            ?>
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="email" class="form-control" name="Email" value="" placeholder="Email Address" required>                                        
                            </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="Password" placeholder="Password" required>
                            </div>
                            
                            <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                            
                            <div class="input-group">
                                <div class="checkbox">
                                    <label>
                                        <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                    </label>
                                </div>
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <div class="col-sm-12 controls">
                                    <button id="btn-login" class="btn btn-success" style="width: 50%;">Login  </button>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        Don't have an account! 
                                        <a href="signup.php">Sign Up Here</a>
                                    </div>
                                </div>
                            </div>    
                        </form> 
                </div>                     
            </div>  
            </div>
        </div>  
      </div>
      <?php include("parts/footer.php");?>
    </body>
</html>