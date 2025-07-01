<?php

    include("conexion.php");

    $sql = "SELECT * FROM teams WHERE id=";
    $result = $conn->query($sql);

    $data = [];

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = [
                'id' => $row["id"],
                'name' => $row["name"],
                'color' => $row["color"],
                'image' => $row["image"],
                'youtube' => $row["youtube"],
                'twitch' => $row["twitch"],
                'twitter' => $row["twitter"],
                'instagram' => $row["instagram"]
            ];
        }
    }

    echo json_encode($data);

?>