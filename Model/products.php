<?php
namespace MODEL;
use Lib\PDOConnection;

class products {
    
    public static function getProducts(){
        $sql = "SELECT * FROM products";
        try{
            $data = PDOConnection::getInstance()->query($sql);   
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    public static function getMenu(){
        $sql = "SELECT * FROM products where enable = 1";
        try{
            $data = PDOConnection::getInstance()->query($sql);   
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    public static function catProducts($categiryId){
        $sql = "SELECT * FROM products  WHERE category_id = ".$categiryId." and enable = 1";
        try{
            $data = PDOConnection::getInstance()->query($sql);   
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    public static function categories(){
        $sql = "SELECT * FROM categories";
        try{
            $data = PDOConnection::getInstance()->query($sql);   
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    public static function  newProduct($ProductName,$ProductPrice,$CategoryID, $path){
         $sql ="INSERT INTO products(`name`, `img_path`,`price`, `enable`, `category_id`) values('".$ProductName."','".$path."',$ProductPrice,1,$CategoryID)";
        
        try{
            $data = PDOConnection::getInstance()->exec($sql);   
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    
     public static function productName($productid){
         
        $sql = "SELECT name, price FROM products WHERE id = ".$productid."";
        try{
            $data = PDOConnection::getInstance()->query($sql);   
            $row = $data->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            return -1;
        }
        return $row;
    }
    
    
     public static function removeProduct ($productid){
     
     $sql = "DELETE FROM products WHERE  id=".$productid."";
     
      try{
            $data = PDOConnection::getInstance()->exec($sql);   
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    public static function updateProduct($id,$price,$status){
         $sql = "UPDATE products set price = ".$price.", enable = ".$status." where id = $id";
         try{
            $data = PDOConnection::getInstance()->query($sql);   
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
}
?>
