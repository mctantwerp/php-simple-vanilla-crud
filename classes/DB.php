<?php 
class DB 
{ 
    
    private static $objInstance; 
        
    public static function getInstance() 
    { 
            
        if(!self::$objInstance)
        { 
            self::$objInstance = new PDO("mysql:host=localhost;dbname=kdg-cms-demo;charset=utf8", "root", ""); 
			self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } 
        
        return self::$objInstance; 
    
    }
    
    final public static function __callStatic( $chrMethod, $arrArguments )
    { 
            
        $objInstance = self::getInstance(); 
        
        return call_user_func_array(array($objInstance, $chrMethod), $arrArguments); 
    }
} 