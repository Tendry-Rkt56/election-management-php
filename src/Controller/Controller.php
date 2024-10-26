<?php

namespace App\Controller;

class Controller 
{

    private $router;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) session_start();
    }

    public function view ($view, $data = [])
    {
        extract($data);
        require_once "../src/View/".str_replace('.','/',$view). '.php';
    }

    public function redirect(string $routeName)
    {
        header('Location: '.$this->router->generate($routeName));
        exit;
    }

}