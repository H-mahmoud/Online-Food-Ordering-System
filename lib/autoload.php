<?php
namespace LIB;

class AutoLoad {

	public static function autoload ($className){
		$className= $className.'.php';
		$className= strtolower($className);
		if(file_exists(realpath(dirname(__FILE__)).'\..\\'. $className)){

			require_once realpath(dirname(__FILE__)).'\..\\' . $className;
		}	
	}

}
try{
    spl_autoload_register(__NAMESPACE__.'\AutoLoad::autoload');   
}catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>
