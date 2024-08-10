<?php

namespace App\Model\Entity;

use App\Manager;

use Exception;

class User extends Entity{

    public function login ($data = []) 
    {  
        $sql = "SELECT * FROM users WHERE email = '$data[email]' AND password = '$data[password]'"; 
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            $_SESSION['user'] = $result->fetch_assoc();
            return true;
        }
        else{
            $_SESSION['error'] = "Identifiant incorrect";
            return false;
        }
    }

    // public function create ($data = [])
    // {
    //     $sql = "INSERT INTO users(nom, prenom, email, password) VALUES (?,?,?,?)";
    //     $result = $this->db->getConn()->prepare($sql);
    //     $result->bind_param("ssss", $data['nom'], $data['prenom'], $data['email'], $data['password']);
    // }

    public function getAllUsers ($data = [])
    {
        $sql = "SELECT * FROM users JOIN matricules ON users.idMatricule = matricules.idMatricule WHERE idUsers > 0";
        if (isset($data['valeur'])) {
            $sql .= " AND users.nom LIKE '%$data[valeur]%' OR users.prenom LIKE '%$data[valeur]%'";
        }
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

    public function deleteUsers ($id)
    {
        $sql = "DELETE FROM users WHERE idUsers = $id";
        return $this->db->getConn()->query($sql);
    }

    public function insertUsers ($id) 
    {
        $notifs = Manager::getManager()->getEntity('notifications');
        $users = $notifs->matriculesOfUsers($id);
        $idMatricule = $notifs->getIdMatricule($users['matricule']);
        $matricule = $idMatricule['idMatricule'];
        $sql = "INSERT INTO users(nom, prenom, email, password, idMatricule) VALUES (?,?,?,?,?)";
        $result = $this->db->getConn()->prepare($sql);
        $result->bind_param("ssssi", $users['nom'], $users['prenom'], $users['email'], $users['password'], $matricule);
        return $result->execute();
    }

    public function getUser ($id) 
    {
        $sql = "SELECT * FROM users WHERE idUsers = $id";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }
        return null;
    }

    private function checkPassword ($id, $data = []) 
    {
        $sql = "SELECT * FROM users WHERE idUsers = $id AND password = '$data[password]'";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            return true;
        }
        return false;
    }

    private function checkEmail ($id, $data = [])
    {
        $sql = "SELECT * FROM users WHERE idUsers != $id AND email = '$data[email]'";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            return false;
        }
        return true;
    }

    public function update ($id, $data)
    {
        $status = true;
        $response = [];
        try {
            if (!$this->checkPassword($id, $data)) {
                $status = false;
                throw new Exception("Votre mot de passe ne correspond pas");
            }
            if (!$this->checkEmail($id, $data)) {
                $status = false;
                throw new Exception("L'email que vous avez entré existe déjà");
            }
            if ($data['newpassword'] != $data['confirm']) {
                $status = false;
                throw new Exception("Veillez verifier votre nouveau mot de passe");
            }
            else {
                $sql = "UPDATE users SET nom = '$data[nom]', prenom = '$data[prenom]', email = '$data[email]', password = '$data[newpassword]' WHERE idUsers = $id";
                $result = $this->db->getConn()->query($sql);
                if ($result) {
                    $status = true;
                    $_SESSION['success'] = "Vos informations ont bien été modifiées";
                    $response = [
                        'status' => $status,
                    ];
                }
                else{
                    $status = false;
                    throw new Exception("Erreur lors de l'insertion des données");
                }
            }

        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $response = [
                'status' => $status,
                "message" => $e->getMessage(),
            ];
        }

        return $response;
    }


}

?>