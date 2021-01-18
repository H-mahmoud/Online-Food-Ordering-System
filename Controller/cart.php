<?php
namespace Controller;
use LIB\VALIDATE;
use Model\products;

class cart  {
    private $ProductId;
    private $ProductName;
    private $Quantity;
    private $Price;
    
    public function __construct(){
        $this->ProductId = array();
        $this->ProductName = array();
        $this->Quantity = array();
        $this->Price = array();
    }
    
    public function add($ID){
        if($ID){
            $Name = products::productName((int)$ID);
            if($Name){
                array_push($this->ProductId, $ID);
                array_push($this->ProductName, $Name['name']);
                array_push($this->Quantity, 1);
                array_push($this->Price,  $Name['price']);
                
                return true;
            }
        }
        return false;
    }
    
    public function delete($ID){
        if (($key = array_search((int)$ID, $this->ProductId)) !== false) {
            
            unset($this->ProductId[$key]);
            $this->ProductId = array_values($this->ProductId);
            unset($this->ProductName[$key]);
            $this->ProductName = array_values($this->ProductName);
            unset($this->Quantity[$key]);
            $this->Quantity = array_values($this->Quantity);
            unset($this->Price[$key]);
            $this->Price = array_values($this->Price);
            
            return true;
        }
        return false;
    }
    
    public function updateQuantity($ID, $Quan){
        if(($key = array_search((int)$ID, $this->ProductId)) !== false){
                $this->Quantity[$key] = (int)$Quan;
                return true;
        }
        return false;
    }
    
    public function view(){
        $result = array();
        for($key = 0; $key < count($this->ProductId); $key++) {
            $result[$key] = array(
                'id'            => $this->ProductId[$key],
                'name'          => $this->ProductName[$key],
                'quantity'      => $this->Quantity[$key],
                'one_price'     => $this->Price[$key],  
                'total_price'   => $this->Price[$key] * $this->Quantity[$key]
            );
        }
        
        return $result;
    }
    
    public function checkOut(){
        $result = array();
        $result["id"] = $this->ProductId;
        $result["name"] = $this->ProductName;
        $result["quantity"] = $this->Quantity;
        $result["total_price"] = 0;
        for($key = 0; $key < count($this->ProductId); $key++) 
            $result["total_price"] += $this->Price[$key] * $this->Quantity[$key];
        
        return $result;
    }
    
    public function clear(){
        $this->__construct();
    }
    
    
}
?>
 
