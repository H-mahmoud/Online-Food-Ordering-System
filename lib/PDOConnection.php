<?php
namespace Lib;

class PDOConnection {
    private static $_instance;
    private static $_handler;

    private function __construct(){
        self::init();
    }
    
    public function exploit($sql){
        $data = self::$_handler->query($sql);
        return $data ;
    }

    public function __call($name, $arguments)
    {
        return @call_user_func_array(array(&self::$_handler, $name), $arguments);				//https://www.php.net/manual/en/function.call-user-func-array.php
    }

    protected static function init()
    {
        try {
            self::$_handler = new \PDO(
                'mysql:hostname=localhost;dbname=ofos_db',
                'root','', array(
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                )
            );
        } catch (\PDOException $e) {
            echo "Failed to connect database";
            self::$_handler = NULL;
        }
    }

    public static function getInstance()
    {
        if(self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
}
?>
