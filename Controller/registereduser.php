<?php
namespace Controller;

class registeredUser{

    protected $id;
    public $FName;
    public $LName;
    public $Email;
    
    public $orderOP;
    
     public function __construct(){
        $this->orderOP = new order();
    }
    
    public function logout(){
        session_unset();
        session_destroy();
    }
}

?>