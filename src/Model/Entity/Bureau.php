<?php

namespace App\Model\Entity;

class Bureau extends Entity {

    public function getBureaux ($data = [])
    {
        $sql = "SELECT bureau.* FROM bureau LEFT JOIN resultats ON resultats.codeBv = bureau.codeBv WHERE resultats.codeBv IS NULL";
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

    public function countBureau (): ?int
    {
        $sql = "SELECT count(*) AS count FROM bureau WHERE codeBv > 0";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows > 0) {
            $count = null;
            while ($rows = $result->fetch_assoc()) {
                $count = $rows['count'];
            }
            return $count;
        }
        return null;
    }

    public function getAllBureau (int $limit, int $page, array $data = []) 
    {   
        $sql = "SELECT * FROM bureau JOIN centreVote ON bureau.idCentre = centreVote.idCentre WHERE bureau.codeBV > 0 ";
        if (isset($data['centre']) && $data['centre'] !== "" && $data['centre'] != -1) {
            $sql .= "AND bureau.idCentre = '$data[centre]'";
        }
        elseif (isset($data['centre']) && $data['centre'] == -1) {
            $sql .= " AND 1 = 1";
        } 
        $offset = ($page - 1 ) * $limit;
        $sql .= " LIMIT $limit OFFSET $offset";
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

    public function getAllCentre ()
    {
        $sql = "SELECT * FROM centrevote WHERE idCentre > 0";
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

    public function create ($data = []) 
    {
        $sql = "INSERT INTO bureau(nomBureau,codeBv,idCentre) VALUES (?,?,?)";
        $statement = $this->db->getConn()->prepare($sql);
        $statement->bind_param("sii", $data['nomBureau'], $data['codeBv'], $data['idCentre']);
        return $statement->execute();
    }

    public function deleteBureau ($id)
    {
        $sql = "DELETE FROM bureau WHERE codeBv = '$id'";
        return $this->db->getConn()->query($sql);
    }

    public function getBureau ($id)
    {
        
        // -- JOIN fokontany ON fokontany.idFokontany = centrevote.idFokontany 
        // -- JOIN commune ON commune.idCommune = fokontany.idcommune 
        // -- JOIN district ON district.idDistrict = commune.idDistrict
        // -- JOIN region ON region.idRegion = district.idRegion 
        // -- JOIN province ON province.idProvince = region.idProvince WHERE bureau.codeBv = '$id';

        $sql = "SELECT bureau.nomBureau AS nomBureau, bureau.codeBv AS codeBv, bureau.idCentre AS idCentre FROM bureau JOIN centrevote 
                ON centrevote.idCentre = bureau.idCentre WHERE bureau.codeBv = '$id'";

        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows !== 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function getBureauAndCentre ($id) 
    {
        $sql = "SELECT * FROM bureau JOIN centrevote 
                ON centrevote.idCentre = bureau.idCentre JOIN fokontany ON fokontany.idFokontany = centrevote.idFokontany WHERE bureau.codeBv = '$id'";

        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows !== 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function updateBureau ($id, $data = [])
    {
        if (isset($data)) {
            $sql = "UPDATE bureau SET ";
            if (isset($data['nomBureau']) && $data['nomBureau'] !== "") {
                $sql .= "nomBureau = '$data[nomBureau]',"; 
            }
            if (isset($data['codeBv']) && $data['nomBureau'] !== "") {
                $sql .= " codeBv = '$data[codeBv]', ";
            }
            if (isset($data['centre']) && $data['centre'] !== "") {
                $sql .= "idCentre = '$data[centre]'";
            }
            $sql .= " WHERE codeBv = '$id'";

            return $this->db->getConn()->query($sql);

        }
        return true;
        
    }

}