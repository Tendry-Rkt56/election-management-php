<?php

namespace App\Model\Entity;

use Exception;

class Candidat extends Entity {

    public function getAllCandidats ()
    {
        $candidats = "SELECT numeroCandidat AS numero, CONCAT(nomCandidat, ' ', prenomCandidat) AS nom, partiePolitique AS partie, imageCandidat AS image  
                      FROM candidat WHERE numeroCandidat > 0";

        $result = $this->db->getConn()->query($candidats);
        if ($result->num_rows > 0) {
            $data = [];
            while ($rows = $result->fetch_assoc()) {
                $data[] = $rows;
            }
            return $data;
        }
        return null;
    }

    public function deleteCandidats ()
    {
        $sql = "DELETE FROM candidat WHERE numeroCandidat > 0";
        return $this->db->getConn()->query($sql);
    }

    public function deleteCandidat ($id)
    {
        $sql = "DELETE FROM candidat WHERE numeroCandidat = $id";
        return $this->db->getConn()->query($sql);
    }

    public function getResultCandidats ($codeBv) 
    {
        $sql = "SELECT * FROM resultats JOIN candidat ON candidat.numeroCandidat = resultats.numeroCandidat
                      WHERE resultats.codeBv = $codeBv";
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

    public function isResult () 
    {
        $sql = "SELECT * FROM resultats WHERE idResultat > 0";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows > 0) {
            return true;
        }
        return false;
    }

    private function requestCandidats ($data = [])
    {
        $sql = "SELECT candidat.nomCandidat, candidat.prenomCandidat, candidat.numeroCandidat,candidat.partiePolitique,imageCandidat, resultats.resultat AS total_voix FROM resultats 
                JOIN candidat ON candidat.numeroCandidat = resultats.numeroCandidat 
                JOIN listeselecteur ON listeselecteur.codeBv = resultats.codeBv 
                JOIN bureau ON bureau.codeBv = listeselecteur.codeBv JOIN centrevote ON centrevote.idCentre = bureau.idCentre
                JOIN fokontany ON fokontany.idFokontany = centrevote.idFokontany JOIN commune ON commune.idCommune = fokontany.idCommune
                JOIN district ON district.idDistrict = commune.idDistrict JOIN region ON region.idRegion = district.idRegion
                JOIN province ON province.idProvince = region.idProvince WHERE 1 = 1";

        if (!empty($data['province'])) {
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

        $sql .= " ORDER BY candidat.numeroCandidat";

        return $sql;
    }

    public function getTotalVoie ($data = []) 
    {
        $sql = "SELECT numeroCandidat, prenomCandidat, partiePolitique,imageCandidat, SUM(total_voix) AS total_voix, 
                nomCandidat FROM ({$this->requestCandidats($data)}) AS Entity_procnkds GROUP BY numeroCandidat";
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

    public function create ($data = [], $files = [])
    {
        $status = true;
        try {
            if (isset($files['image']) && $files['image']['name'] !== "") {
                $destination = "image/";
                $nomImage = $files['image']['name'];
                $cheminFichier = $destination . $nomImage;
                $extensions = ['jpg','jpeg','png'];
                $extension = pathinfo($nomImage, PATHINFO_EXTENSION);
                if (in_array(strtolower($extension), $extensions)) {
                    if (move_uploaded_file($files['image']['tmp_name'], $cheminFichier)) {
                        $sql = "INSERT INTO candidat (nomCandidat, prenomCandidat, numeroCandidat, partiePolitique, imageCandidat) VALUES (?,?,?,?,?)";
                        $result = $this->db->getConn()->prepare($sql);
                        $result->bind_param("ssiss",$data['nom'], $data['prenom'],$data['numero'], $data['partie'],$cheminFichier);
                        $status = $result->execute();
                    }
                    else {
                        $status = false;
                        throw new Exception("Erreur lors du téléchargement de l'image");
                    }
                } 
                else {
                    $status = false;
                    throw new Exception("L'image n'est pas prise en charge");
                }
            }   
            else {
                $sql = "INSERT INTO candidat (nomCandidat, prenomCandidat, numeroCandidat, partiePolitique, imageCandidat) VALUES (?,?,?,?,?)";
                $result = $this->db->getConn()->prepare($sql);
                $image = ' ';
                $result->bind_param("ssiss", $data['nom'],$data['prenom'],$data['numero'], $data['partie'],$image);
                $status = $result->execute();
            } 

            $response = [
                'status' => $status,
            ];
        }
        catch (Exception $e) {
            $response = [
                'status' => $status,
                'message' => $e->getMessage(),
            ];
        }
        return $response;
    }

    public function edit ($id) 
    {
        $sql = "SELECT * FROM candidat WHERE numeroCandidat = $id";
        $result = $this->db->getConn()->query($sql);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function update ($id, $data = [], $files = []) 
    {
        $status = true;
        try {
            $sql = "UPDATE candidat SET nomCandidat = '$data[nom]', 
                prenomCandidat = '$data[prenom]', numeroCandidat = '$data[numero]', 
                partiePolitique = '$data[partie]'";
            if (isset ($files['image']) && $files['image']['name'] !== "") {
                $candidat = $this->edit($id);
                if (isset($candidat['imageCandidat']) && file_exists($candidat['imageCandidat'])) {
                    if (unlink($candidat['imageCandidat'])) {
                        $status = true;
                    }
                }
                $destination = "image/";
                $nomImage = $files['image']['name'];
                $cheminFichier = $destination . $nomImage;
                $extensions = ['jpg','jpeg','png'];
                $extension = pathinfo($nomImage, PATHINFO_EXTENSION);
                if (in_array(strtolower($extension), $extensions)) {
                    if (move_uploaded_file($files['image']['tmp_name'], $cheminFichier)) {
                        $sql .= ", imageCandidat = '$cheminFichier'";
                    }
                    else {
                        $status = false;
                        throw new Exception("Erreur lors du téléchargement de l'image");
                    }
                } 
                else {
                    $status = false;
                    throw new Exception("L'image n'est pas prise en charge");
                }
            }
            $sql .= " WHERE numeroCandidat = $id";
            $result = $this->db->getConn()->query($sql);
            $response = [
                'status' => $status && $result,
            ];
        }
        catch (Exception $e){
            $response = [
                'status' => $status,
                'message' => $e->getMessage(),
            ];
        }

        return $response;
    }


}