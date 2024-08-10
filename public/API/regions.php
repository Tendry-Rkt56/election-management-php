<?php
    $conn = new mysqli ('localhost', 'root', 'root', 'gestionelection');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents('php://input'));
        $id = $data->id;
        $sql = "SELECT district.idDistrict, district.nomDistrict FROM district JOIN region ON region.idRegion = district.idRegion WHERE region.idRegion = $id";     
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($rows = $result->fetch_assoc()) {
                $data[] = $rows;
            }
        }

        header('Content-Type: application/json');
        echo json_encode ($data);
    }
?>