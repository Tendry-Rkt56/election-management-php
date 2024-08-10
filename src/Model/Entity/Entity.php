<?php

namespace App\Model\Entity;

use Config\DataBase;

class Entity {

    public $db;

    public function __construct(DataBase $db)
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->db = $db;
    }

}

?>