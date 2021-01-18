<?php
namespace Controller;
use LIB\VALIDATE;
use Model\users;
use Model\products;

class Menu{
    
    public function listMenu(){
        return products::getMenu();
    }
    
    public function menuCategory($categoryId){
        $categoryId = (int)Validate::secure($categoryId);
        return products::catProducts($categoryId);
    }
    
    public function getCategories(){
        return products::categories();
    }
}
?>
