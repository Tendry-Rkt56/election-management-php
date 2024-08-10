<?php

namespace App\Model\Entity;

class Demande extends Entity {

    public function insertDemandes ($idNotif, $data = [])
    {
        $sql = "INSERT INTO demandes (nom,matricule,idNotif,prenom,email,password) VALUES (?,?,?,?,?,?)";
        $result = $this->db->getConn()->prepare($sql);
        $result->bind_param('ssisss', $data['nom'], $data['matricule'], $idNotif, $data['prenom'],$data['email'], $data['password']);
        return $result->execute();
    }

    public function getDemandes ($id) 
    {
        $sql = "SELECT nom, matricule, prenom, email, password FROM demandes WHERE idNotif = $id";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }
        return null;
    }


}

?>