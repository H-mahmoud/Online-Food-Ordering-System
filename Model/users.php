<?php
namespace MODEL;
use Lib\PDOConnection;

class users {
    
    
    public static function addUsers($F_Name,$L_Name,$Password,$E_mail){
        $sql = "INSERT INTO users (`first_name`, `last_name`, `email`, `password`, `role_id`) values('".$F_Name."','".$L_Name."','".$E_mail."','".$Password."', 2)";
        
        try{
            $data = PDOConnection::getInstance()->exec($sql);
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    public static function getUsers($Email, $Password){
        $sql = "SELECT * FROM users where email = '".$Email."' and binary password = '".$Password."'";
        try{
            $data = PDOConnection::getInstance()->query($sql);
        }catch(\PDOException $e){
            return -1;
        }

        return $data;
    }
    
    
    public static function viewUsers(){
         $sql = "SELECT id, first_name, last_name, email FROM users where role_id = 2 ";
         try{
            $data = PDOConnection::getInstance()->query($sql);   
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
}
?>
