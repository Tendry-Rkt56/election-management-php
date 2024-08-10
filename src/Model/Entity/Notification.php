<?php

namespace App\Model\Entity;

class Notification extends Entity {

    public function insertNotifications ($type)
    {
        $sql = "INSERT INTO notifications (type) VALUES (?)";
        $result = $this->db->getConn()->prepare($sql);
        $result->bind_param("s",$type);
        $result->execute();
        return $result->insert_id;
    }

    public function getUnReadNotif ()
    {
        $sql = "SELECT * FROM notifications WHERE idNotif > 0 AND isRead = 0";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($rows = $result->fetch_assoc()) {
                $data[] = $rows;
            }
            return $data;
        }
        return null;
    }

    public function getAllNotifications () 
    {
        $sql = "SELECT * FROM notifications WHERE idNotif > 0 ORDER BY idNotif DESC";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($rows = $result->fetch_assoc()) {
                $data[] = $rows;
            }
            return $data;
        }
        return null;
    }

    public function updateNotif ($id) 
    {
        $sql = "UPDATE notifications SET isRead = 1 WHERE isRead = 0 AND idNotif = $id";
        $this->db->getConn()->query($sql);
    }

    private function getMatriculesOnUsers ()
    {
        $sql = "SELECT matricule FROM matricules JOIN users ON users.idMatricule = matricules.idMatricule WHERE users.idUsers > 0";
        $results = $this->db->getConn()->query($sql);
        if ($results->num_rows > 0) {
            $data = [];
            while ($rows = $results->fetch_assoc()) {
                $data[] = $rows;
            }
            return $data;
        }
        return null;
    }

    public function getAllMatricules () {
        $sql = "SELECT matricule FROM matricules WHERE idMatricule > 0";
        $results = $this->db->getConn()->query($sql);
        if ($results->num_rows > 0) {
            $data = [];
            while ($rows = $results->fetch_assoc()) {
                $data[] = $rows;
            }
            return $data;
        }
        return null;
    }

    public function getIdMatricule ($matricule)
    {
        $sql = "SELECT idMatricule FROM matricules WHERE matricule = '$matricule'";
        $result = $this->db->getConn()->query($sql); 
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function matriculesOfUsers ($id) 
    {
        $sql = "SELECT * FROM demandes JOIN notifications ON notifications.idNotif = demandes.idNotif WHERE notifications.idNotif = $id";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function getNotificationAndDemande ($id)
    {   
        $sql = "SELECT * FROM demandes JOIN notifications ON notifications.idNotif = demandes.idNotif WHERE notifications.idNotif = $id";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            $rows = $result->fetch_assoc();
        }

        $Entityaux = $this->getAllMatricules();
        $EntityauxUsed = $this->getMatriculesOnUsers();
        $status = false;
        $valeur = "Le  N° de matricule qu'il a entré n'existe pas";
        for ($i = 0; $i < count($Entityaux); $i++) {
            if ($Entityaux[$i]['matricule'] == $rows['matricule']) {
                $status = true;
                $valeur = null;
                break;
            }
        }
        
        for ($i = 0; $i < count($EntityauxUsed); $i++) {
            if ($EntityauxUsed[$i]['matricule'] == $rows['matricule']) {
                $status = false;
                $valeur = "Le matricule $rows[matricule] est déjà utilisée par un autre utilisateur";
                break; 
            }
        }

        return $response = [
            'status' => $status,
            'valeur' => $valeur,
        ];
        
    }

    public function deleteNotification ($id)
    {
        $sql = "DELETE FROM notifications WHERE idNotif = $id";
        return $this->db->getConn()->query($sql);
    }


}