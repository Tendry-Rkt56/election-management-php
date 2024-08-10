<?php

namespace App\Middleware;

class UsersMiddleware {

    private static $routes = ['/Users/loginView', '/Users/login'];

    public function __construct($uri)
    {
        if (session_status() == PHP_SESSION_NONE) session_start();   
    }

    public static function redirect ()
    {
        if (!isset($_SESSION['user']) && !in_array($_SERVER['REQUEST_URI'], self::$routes) && strpos($_SERVER['REQUEST_URI'], "/Users") !== false){
            // var_dump($uri);
            header('Location: /Users/loginView');
            exit();
        }
        elseif (isset($_SESSION['user']) && in_array($_SERVER['REQUEST_URI'], self::$routes) && strpos($_SERVER['REQUEST_URI'], '/Users') !== false) {
            header ('Location: /Users');
            exit();
        }
    }

    public static function request ($uri) 
    {
        return !isset($_SESSION['user']) && !in_array($uri, self::$routes) && strpos($uri, "/Users") !== false;
    }


}

?>