<?php
namespace Controller;
use LIB\VALIDATE;
use Model\users;
use Model\products;

class user extends registereduser{
    public $menuOP;
    public $cartOP;
    
    public function __construct(){
        $this->menuOP = new Menu();
        $this->cartOP = new cart();
        parent::__construct();
    }
}

?>