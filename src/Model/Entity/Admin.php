<?php

namespace App\Model\Entity;

class Admin extends Entity {


    public function index ()
    {
        $sql = "SELECT * FROM candidat WHERE numeroCandidat > 0";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($rows = $result->fetch_assoc()){
                $data[] = $rows;
            }
            return $data;
        }
        return null;
    }

    public function doLogin ($data = []) 
    {
        $sql = "SELECT * FROM admins WHERE email = '$data[email]' AND password = '$data[password]'";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            $rows = $result->fetch_assoc();
            $_SESSION['admin'] = $rows;
            return true;
        }
        else{
            $_SESSION['error'] = "Identifiants incorrect";
            return false;
        }
    }

    public function inscription ($data = [])
    {
        $sql = "INSERT INTO admins (nom, prenom, email, password) VALUES (?,?,?,?)";
        $result = $this->db->getConn()->prepare($sql);
        $result->bind_param("ssss", $data['nom'], $data['prenom'], $data['email'], $data['password']);
        return $result->execute();
    }

}

?>