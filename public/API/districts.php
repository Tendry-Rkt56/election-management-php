<?php
    $conn = new mysqli ('localhost', 'root', 'root', 'gestionelection');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents('php://input'));
        $id = $data->id;
        $sql = "SELECT commune.idCommune, commune.nomCommune FROM commune JOIN district ON district.idDistrict = commune.idDistrict WHERE district.idDistrict = $id";
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