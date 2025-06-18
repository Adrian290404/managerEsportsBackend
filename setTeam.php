<?php

    include("conexion.php");

    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    $team = $data['team'];
    $stmt = $conn->prepare("INSERT INTO teams (name, color, image, twitch, youtube, twitter, instagram) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssss",
        $team['name'],
        $team['color'],
        $team['image'],
        $team['twitch'],
        $team['youtube'],
        $team['twitter'],
        $team['instagram']
    );

    $stmt->execute();
    $team_id = $conn->insert_id;
    $stmt->close();

?>