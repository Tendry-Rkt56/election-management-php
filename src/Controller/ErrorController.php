<?php 

namespace App\Controller;

class ErrorController extends Controller {

    public function index () 
    {
        return $this->view ('errors.index');
    }

}