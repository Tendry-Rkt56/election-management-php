<?php

namespace App\Model\Entity;

class Province extends Entity {

    public function getAllProvinces ()
    {
        $sql = "SELECT * FROM province";
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