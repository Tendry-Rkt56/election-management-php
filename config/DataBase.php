<?php

namespace Config;

class DataBase {

    private $conn;
    private $dbname;

    public function __construct ($dbname) 
    {
        $this->dbname = $dbname;
        $this->conn = new \mysqli(DB_HOST, DB_USER, DB_PASS, $this->dbname);
        $this->conn->set_charset('utf8');
    }

    public function getConn ()
    {
        return $this->conn;
    }


    public function close () 
    {
        return $this->conn->close();
    }


}


?>