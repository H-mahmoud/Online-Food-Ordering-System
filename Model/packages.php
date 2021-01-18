<?php
namespace MODEL;
use Lib\PDOConnection;

class packages {
    
    public static function add($o_id, $p_id, $qaun){
        $sql = "INSERT INTO packages(`quantity`, `order_id`, `product_id`) values(".$qaun.",".$o_id.",".$p_id.")";
        
        try{
            $data = PDOConnection::getInstance()->exec($sql);
        }catch(\PDOException $e){
            return $e->getMessage();
        }
        return $data;
    }
    
    public static function view($id){
        $sql = "SELECT quantity, product_id, name FROM packages, products where products.id = product_id and packages.order_id = $id";
        try{
            $data = PDOConnection::getInstance()->query($sql);
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    
}
?>
