<?php

namespace App\Model\Entity;

class Centre extends Entity {

    public function getAllCentreVote ()
    {
        $sql = "SELECT * FROM centrevote WHERE idCentre > 0";
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

}

?>