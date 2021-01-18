<?php
namespace Controller;
use LIB\VALIDATE;
use LIB\upload;
use Model\users;
use Model\products;
use Model\orders;

class admin extends registereduser{
	
    public $menuOP;
    
    public function __construct(){
        $this->menuOP = new Menu();
        parent::__construct();
    }
    
	public function addItem ($name,$price,$category,$image){
        $name = Validate::secure($name);
        $price = (int)$price;
        $category = Validate::secure($category);
        $path = upload::check($image);
        if($path){
            $data = products::newProduct($name, $price, $category, $path);
            return $data;
        }
        
        return -1;

	}
    
    public function getProducts(){
        return products::getProducts();
    }

	public function deleteItem($id){
        return products::removeProduct($id);
    }
    
    public function updateItem($id,$price,$status){
        return products::updateProduct((int)$id,(int)$price,(int)$status);
    }
    
    public function viewUsers(){
        return users::viewUsers();
    }
}
	
?>
