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
        <div style="margin-top: 20px;margin-left: 25%;" class="col-lg-6 col-md-6 col-sm-8">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <img src="images/chefProfile.png" style="width: 20%;">
                        <div class="panel-title" style="font-size: 20px;font-weight: bold;">Sign up</div>
                    </div>     

                    <div style="padding-top:20px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post">
                             <?php
                                if(isset($_POST['Email']) && isset($_POST['Password']) && isset($_POST['VPassword']) && isset($_POST['Lname']) && isset($_POST['Fname'])){
                                    
                                    $check = $op->register($_POST['Fname'],$_POST['Lname'],$_POST['Password'],$_POST['VPassword'],$_POST['Email']);
                                    
                                    switch($check){
                                        case 1:
                                            echo '<div class="alert alert-success" role="alert">
                                            Registered successfuly move to the login page to access your profile.
                                            </div>';
                                        break;
                                        case -2;
                                            echo '<div class="alert alert-danger" role="alert">
                                            Password doesn\'t match.
                                            </div>';
                                        break;
                                        case -1;
                                            echo '<div class="alert alert-danger" role="alert">
                                            Email already exist.
                                            </div>';
                                        break;
                                        case -3;
                                            echo '<div class="alert alert-danger" role="alert">
                                            Wrong email format.
                                            </div>';
                                        break;
                                        
                                    }
                                }
                            ?>
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="Fname" placeholder="First Name" required>                                        
                                    </div>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" name="Lname" placeholder="Last Name" required>                                        
                                    </div>
                            
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="email" class="form-control" name="Email" value="" placeholder="Email Address" required>                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="Password" placeholder="Password" required>
                                    </div>
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="VPassword" placeholder="Confirm Password" required>
                                    </div>
                                    

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="policy" type="checkbox" name="remember" value="1" required> accept policy and terms
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <button id="btn-login" class="btn btn-success" style="width: 50%;">Sign UP  </button>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Already have account
                                        <a href="login.php">
                                            Login Here
                                        </a>
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