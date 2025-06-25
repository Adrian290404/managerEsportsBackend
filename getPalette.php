<?php

    include("conexion.php");

    $sql = "SELECT color FROM teams WHERE id = $id";
    $result = $conn->query($sql);

    $data;

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data = $row;
        }
    }

    echo json_encode($data);

?>