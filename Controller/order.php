<?php
namespace Controller;
use LIB\VALIDATE;
use Model\orders;
use Model\packages;

class order{
    
    public function placeOrder($name, $address, $phone, $products_id, $price, $quantity){
        if($_SESSION['role'] == "user"){
            $name = VALIDATE::secure($name);
            $address = VALIDATE::secure($address);
            $phone = VALIDATE::secure($phone);
            $date = date("Y-m-d");
            $price = (double)$price;
            
            $id = orders::newOrder($name, $address, $phone, $date, $price, $_SESSION['id']);
            
            if($id > 0){
                for($key = 0; $key < count($products_id); $key++) {
                    $check = packages::add($id, $products_id[$key], $quantity[$key]);
                    if(!$check)
                        return false;
                }
            }else
                return false;
            
            return $id;
        }
        return false;
    }
    
    public function viewOrders(){
        
        switch($_SESSION['role']){
            case "user":
                return orders::myActiveOrders($_SESSION['id']);
            break;
            case "admin":
                return orders::getActiveOrders();
            break;
            default:
                return false;
        }
        
        return false;
    }
    
    public function viewOrdersHistory(){
        
        switch($_SESSION['role']){
            case "user":
                return orders::myOrdersHistory($_SESSION['id']);
            break;
            case "admin":
                return orders::getOrdersHistory("any");
            break;
            default:
                return false;
        }
        
        return false;
    }
    
    public function updateOrderStatus($id,$status){
        
        if($_SESSION['role'] == "admin"){
            return orders::updateStatus((int)$id, (int)$status);
        }
        
        return false;
    }
    
    public function deliveryInformation($o_id){
        
        $information = array();

        switch($_SESSION['role']){
            case "user":
                $information['delivery'] = orders::mydeliveryDetails($_SESSION['id'], (int)$o_id);
                if($information['delivery']){
                     $information['package'] = $this->packageInforamtion((int)$o_id);
                    return $information;
                }else
                    return -1;
                
            break;
            case "admin":
                $information['delivery'] = orders::getdeliveryDetails((int)$o_id);
                if($information['delivery']){
                    $information['package'] = $this->packageInforamtion((int)$o_id);
                    return $information;
                }else
                    return -1;
                     
                
            break;
            default:
                return false;
        }
        
        return false;
    }
    
    private function packageInforamtion($o_id){
        
        return packages::view((int)$o_id);
    }
    
    
}

?>