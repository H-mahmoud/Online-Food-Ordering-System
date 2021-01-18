<?php
namespace MODEL;
use Lib\PDOConnection;

class orders {
    
    public static function myActiveOrders($id){
        $sql = "SELECT `id`, `date` FROM orders where user_id = ".$id." and status_id = 1";
        try{
            $data = PDOConnection::getInstance()->query($sql);
        }catch(\PDOException $e){
            return -1;
        }

        return $data;
    }
    
    public static function getActiveOrders(){
        $sql = "SELECT `id`, `date` FROM orders where status_id = 1";
        try{
            $data = PDOConnection::getInstance()->query($sql);
        }catch(\PDOException $e){
            return -1;
        }

        return $data;
    }
    
    public static function myOrdersHistory($id){
        $sql = "SELECT * FROM orders where user_id = ".$id." and (status_id = 2 OR status_id = 3)";
        try{
            $data = PDOConnection::getInstance()->query($sql);
        }catch(\PDOException $e){
            return -1;
        }

        return $data;
    }
    
    public static function getOrdersHistory($id){
        $sql = "SELECT * FROM orders where (status_id = 2 OR status_id = 3)";
        try{
            $data = PDOConnection::getInstance()->query($sql);
        }catch(\PDOException $e){
            return -1;
        }

        return $data;
    }
    
    public static function getdeliveryDetails( $order_id){
        $sql = "SELECT total_price, agent_name, adress, phone_number, status_id, id FROM orders where id = ".$order_id." ";
        try{
            $data = PDOConnection::getInstance()->query($sql);
            $row = $data->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            return -1;
        }

        return $row;
    }
    
    public static function mydeliveryDetails($user_id, $order_id){
        $sql = "SELECT total_price, agent_name, adress, phone_number , status_id FROM orders where user_id = ".$user_id." and id = ".$order_id." ";
        try{
            $data = PDOConnection::getInstance()->query($sql);
            $row = $data->fetch(\PDO::FETCH_ASSOC);
        }catch(\PDOException $e){
            return -1;
        }

        return $row;
    }
    
    public static function newOrder($name, $address, $phone, $date, $price, $user_id){
        $sql = "INSERT INTO orders (`agent_name`, `adress`, `phone_number`, `date`, `total_price`, `user_id`, `status_id`) values('".$name."','".$address."',".$phone.",'".$date."', ".$price.", ".$user_id.", 1)";
        $id = "SELECT LAST_INSERT_ID()";
        
        try{
            $data = PDOConnection::getInstance()->exec($sql);
            if($data){
                $data = PDOConnection::getInstance()->query($id);
                $data = $data->fetch(\PDO::FETCH_ASSOC);
                $data = $data["LAST_INSERT_ID()"];
            }
        }catch(\PDOException $e){
            return -1;
        }
        return $data;
    }
    
    public static function updateStatus($id,$status){
        $sql = "update orders set status_id = ".$status." where id = ".$id."";
        try{
            $data = PDOConnection::getInstance()->exec($sql);
        }catch(\PDOException $e){
            return $e->getMessage();
        }
        return $data;
    }
    
}
?>
