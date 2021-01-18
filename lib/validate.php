<?php
namespace LIB;

class Validate {

	public static function secure ($var){
		return htmlspecialchars($var, ENT_QUOTES);
	}
    
    public static function isEmail ($var){
		return filter_var($var, FILTER_VALIDATE_EMAIL);
	}

}
?>
