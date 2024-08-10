<?php

namespace App\Model\Entity;

use Exception;

class Resultat extends Entity {

    /**
     * Tsy ilaina akory
     */
    public function getResultats ($data = [])
    {
        $sql =  "SELECT resultats.* FROM resultats JOIN bureau ON 
        bureau.codeBv = resultats.codeBv
        JOIN centrevote ON centrevote.idCentre = bureau.idCentre
        JOIN fokontany ON fokontany.idFokontany = centrevote.idFokontany
        JOIN commune ON commune.idCommune = fokontany.idcommune 
        JOIN district ON district.idDistrict = commune.idDistrict
        JOIN region ON region.idRegion = district.idRegion
        JOIN province ON province.idProvince = region.idProvince WHERE 1 = 1";
        
        if (!empty($data['provinces'])) {
            $sql .= " AND province.idProvince = '$_GET[provinces]'";
        }

        if (!empty($data['regions'])) {
            $sql .= " AND region.idRegion = $_GET[regions]";
        }
        if (!empty($data['districts'])) {
            $sql .= " AND district.idDistrict = $_GET[districts]";
        }
        if (!empty($data['communes'])) {
            $sql .= " AND commune.idCommune = $_GET[communes]";
        }
        if (!empty($data['fokontany'])) {
            $sql .= " AND fokontany.idFokontany = $_GET[fokontany]";
        }
        if (!empty($data['centrevotes'])) {
            $sql .= " AND centrevote.idCentre = $_GET[centrevotes]";
        }
        if (!empty($data['bureaudevotes'])) {
            $sql .= " AND bureau.codeBv = $_GET[bureaudevotes]";
        }
        
        return $sql;
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($rows = $result->fetch_assoc()) {
                $data[] = $rows;
            }
        }
        else {
            return null;
        }

        $candidates = [];
        foreach($data as $result) {
            $id = $result['numeroCandidat'];
            $req = "SELECT * FROM candidat WHERE numeroCandidat = '$result[numeroCandidat]'";
            $candidats = $this->db->getConn()->query($req);

            while ($rows = $candidats->fetch_assoc()) {
                $candidates[$result['numeroCandidat']] = $rows;
            }
        }

        for ($i = 0; $i < count($data); $i++) {
            $id = $data[$i]['numeroCandidat'];
            $data[$i]['candidat'] = $candidates[$id];
        }
        return $data;
    }
    //----------------------------------------------------------------------------

    /**
     * Requête pour obtenir la liste des élécteurs et des informations sur total des élécteurs et des voies blanches et nulles 
     * dans la Entity listeselecteurs
     */
    private function request ($data = []) 
    {
        $sql = "SELECT * FROM listeselecteur JOIN bureau ON bureau.codeBv = listeselecteur.codeBv 
                JOIN centrevote ON centrevote.idCentre = bureau.idCentre JOIN fokontany ON fokontany.idFokontany = centrevote.idFokontany 
                JOIN commune ON commune.idCommune = fokontany.idcommune JOIN district ON district.idDistrict = commune.idDistrict 
                JOIN region ON region.idRegion = district.idRegion JOIN province ON province.idProvince = region.idProvince 
                WHERE 1 = 1 AND listeselecteur.nombresVotants IS NOT NULL";

        // return $data['provinces'];
        if (!empty($data['provinces'])) {
            $sql .= " AND province.idProvince = {$data['provinces']}";
        }

        if (!empty($data['regions'])) {
            $sql .= " AND region.idRegion = {$data['regions']}";
        }
        if (!empty($data['districts'])) {
            $sql .= " AND district.idDistrict = {$data['districts']}";
        }
        if (!empty($data['communes'])) {
            $sql .= " AND commune.idCommune = {$data['communes']}";
        }
        if (!empty($data['fokontany'])) {
            $sql .= " AND fokontany.idFokontany = {$data['fokontany']}";
        }
        if (!empty($data['centrevotes'])) {
            $sql .= " AND centrevote.idCentre = {$data['centrevotes']}";
        }
        if (!empty($data['bureaudevotes'])) {
            $sql .= " AND bureau.codeBv = {$data['bureaudevotes']}";
        }
        $sql .= " ORDER BY province.nomProvince";
        return $sql;
    }

    public function resultats ($data = [])
    {
        $sql = $this->request($data);
        // return $sql;
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

    public function getAllStatistiques ($data = []) 
    {
        $sql = "SELECT SUM(nombreElecteurs) AS total FROM ({$this->request($data)} AS Entitys_personnes) GROUP BY province.idProvince";
        // return $sql;
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

    public function insertResult ($data = [])
    {
        $dataLength = (count($data) - 4) / 2;
        $codeBv = $data['codeBv'];
        $nombreVotants = $data['nombreVotants'];
        $voieNull = $data['voieNull'];
        $voieBlanche = $data['voieBlanche'];
        $status = true;
        $response = [];

        $this->db->getConn()->begin_transaction();

        echo $voieBlanche + $voieNull;

        try{
            if ($nombreVotants > $this->getTotalElecteur($codeBv)) {
                $status = false;
                throw new Exception('Le nombre de votants ne peut pas être supérieur aux nombres d\'élécteurs dans un bureau');
            }
            else {
                $sql = "INSERT INTO resultats (resultat, numeroCandidat, codeBv) VALUES (?,?,?)";
                $result = $this->db->getConn()->prepare($sql);
                $voieExprime = 0;
                // for ($i = 1; $i <= $dataLength; $i++) {
                //     $resultat = $data['resultat-' . $i];
                //     $numeroCandidat = $i;
                //     $voieExprime += $resultat;
                //     // $result->bind_param("iii", $resultat, $numeroCandidat, $codeBv);
                //     // if (!$result->execute()) {
                //     //     throw new Exception("Erreur lors de l'insertion des resultats");
                //     //     $status = false;
                //     //     break;
                //     // }
                // }

                foreach($data as $key => $value) {
                    if (strpos($key, 'resultat-') !== false) {
                        $numeroCandidat = substr($key, strlen('resultat-'));
                        $voieExprime += $value;
                        $result->bind_param("iii", $value, $numeroCandidat, $codeBv);
                        if (!$result->execute()) {
                            throw new Exception("Erreur lors de l'insertion des resultats");
                            $status = false;
                            break;
                        }
                    }
                }

                $voieExprime += ($voieBlanche + $voieNull);
                
                $req = "UPDATE listeselecteur SET nombresVotants = ?, voteNull = ?, voteBlanche = ?, voteExprime = ? WHERE listeselecteur.codeBv = ?";
                $results = $this->db->getConn()->prepare($req);
                $results->bind_param("iiiii", $nombreVotants, $voieNull, $voieBlanche, $voieExprime, $codeBv);
                $results->execute();
                $this->db->getConn()->commit();
                $status = true;
                $response = [
                    "status" => $status,
                ];
            }       
        }
        catch (Exception $e) {
            $this->db->getConn()->rollback();
            $response = [
                'status' => false,
                "messages" => $e->getMessage(),
                "nombreVotants" => $nombreVotants,
                "nombreElecteurs" => $this->getTotalElecteur($codeBv),
            ];
        }

        return $response;
    }

    public function sumResult ($codeBv = null) 
    {
        if (isset($codeBv) && !empty($codeBv) && $codeBv !== null) {
            $sql = "SELECT * FROM listeselecteur JOIN bureau ON bureau.codeBv = listeselecteur.codeBv WHERE listeselecteur.codeBv = $codeBv";
            $result = $this->db->getConn()->query($sql);
            if ($result->num_rows == 1) {
                $rows = $result->fetch_assoc();
                return $rows;
            }
            return null;
        }
    }

    private function getTotalElecteur ($codeBv) 
    {
        return $this->sumResult($codeBv)['nombreElecteurs'];
    }


    public function getAllResults ($codeBv)
    {
        $sql = "SELECT * FROM bureau WHERE codeBv = $codeBv";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows > 0) {
            $bureau = $result->fetch_assoc();
        }

        $req = "SELECT * FROM resultats WHERE codeBv = $codeBv";
        $results = $this->db->getConn()->query($req);
        if ($results->num_rows > 0) {
            $data = [
                'bureau' => $bureau,
                'resultats' => [],
            ];
            while ($rows = $results->fetch_assoc()) {
                $data['resultats'][] = $rows; 
            }
            return array_values($data);
        }
    }

    public function getStatElecteurs ($codeBv)
    {
        $sql = "SELECT nombreElecteurs, voteNull, voteBlanche, voteExprime, nombresVotants, (voteExprime * 100) / nombreElecteurs AS taux FROM 
                listeselecteur WHERE listeselecteur.codeBv = $codeBv";
        $result = $this->db->getConn()->query($sql);
        return $result->fetch_assoc();
    }

    public function deleteResultats ($codeBv) 
    {
        $sql = "DELETE FROM resultats WHERE codeBv = $codeBv";
        $result = $this->db->getConn()->query($sql);
        return $result;
    }

    public function deleteAllResults ()
    {
        $sql = "DELETE FROM resultats WHERE idResultat > 0";
        return $this->db->getConn()->query($sql);
    }
}

?>