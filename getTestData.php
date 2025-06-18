<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    include("conexion.php");

    $sql = "SELECT * FROM test";
    $result = $conn->query($sql);

    $data = [];

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    echo json_encode($data);
?>
