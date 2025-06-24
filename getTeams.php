<?php

    include("conexion.php");

    $sql = "SELECT id, name, image FROM teams";
    $result = $conn->query($sql);

    $data = [];

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = [
                'id' => $row["id"],
                'name' => $row["name"],
                'image' => $row["image"]
            ];
        }
    }

    echo json_encode($data);

?>