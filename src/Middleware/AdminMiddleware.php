<?php

namespace App\Middleware;

class AdminMiddleware {

    private static $routes = ['/Admin/loginView', '/Admin/login'];

    public function __construct($uri)
    {
        if (session_status() == PHP_SESSION_NONE) session_start();   
    }

    public static function redirect ()
    {
        if (!isset($_SESSION['admin']) && !in_array($_SERVER['REQUEST_URI'], self::$routes) && strpos($_SERVER['REQUEST_URI'], "/Admin") !== false){
            // var_dump($uri);
            header('Location: /Admin/loginView');
            exit();
        }
        elseif (isset($_SESSION['admin']) && in_array($_SERVER['REQUEST_URI'], self::$routes) && strpos($_SERVER['REQUEST_URI'], '/Admin') !== false) {
            header ('Location: /Admin');
            exit();
        }
    }

    public static function request ($uri) 
    {
        return !isset($_SESSION['admin']) && !in_array($uri, self::$routes) && strpos($uri, "/Admin") !== false;
    }


}

?>