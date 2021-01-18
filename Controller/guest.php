<?php
namespace Controller;
use LIB\VALIDATE;
use Model\users;
use Model\products;


class guest {
    

    public $menuOP;
    
    public function __construct(){
        $this->menuOP = new Menu();
    }
    
    public function register($FName,$LName,$Password,$VPassword,$Email) {
        $FName = Validate::secure($FName);
        $LName = Validate::secure($LName);
        $Password = Validate::secure($Password);
        $VPassword = Validate::secure($VPassword);
        if($Password == $VPassword && Validate::isEmail($Email)){
            return users::addUsers($FName,$LName,$Password,$Email);    
        }else{
            if($Password != $VPassword)
                return -2;
            else
                return -3;
        }
    }
    
    public function login($Email,$Password){
            if(Validate::isEmail($Email)){
                return users::getUsers($Email, $Password);
            }
            return -1;
    }
       

}
?>
 
