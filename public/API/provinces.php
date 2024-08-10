<?php
    $conn = new mysqli ('localhost', 'root', 'root', 'gestionelection');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents('php://input'));
        $id = $data->id;
        $sql = "SELECT region.idRegion, region.nomRegion 
                FROM region JOIN province ON region.idProvince = province.idProvince 
                WHERE province.idProvince = $id";
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