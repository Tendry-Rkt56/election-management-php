<?php
    $conn = new mysqli ('localhost', 'root', 'root', 'gestionelection');
    mysqli_set_charset($conn, 'UTF8');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $donnee = json_decode(file_get_contents('php://input'));
        $id = $donnee->id;
        $sql = "SELECT centrevote.idCentre, centrevote.nomCentre 
                FROM centrevote JOIN fokontany ON fokontany.idFokontany = centrevote.idFokontany 
                WHERE fokontany.idFokontany = $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = [];
            while ($rows = $result->fetch_assoc()) {
                $data[] = $rows;
            }
        }
        else {
            $data = ['vide' => 'vide'];
        }

        header('Content-Type: application/json');
        echo json_encode ($data);
    }
?>