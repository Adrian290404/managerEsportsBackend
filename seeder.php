<?php

    include("conexion.php");


    $teams = "CREATE TABLE IF NOT EXISTS teams (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        color VARCHAR(10),
        image VARCHAR(255),
        youtube VARCHAR(255),
        twitch VARCHAR(255),
        twitter VARCHAR(255),
        instagram VARCHAR(255)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($teams) === TRUE) {
        echo "Tabla 'teams' creada correctamente.\n";
    } 
    else {
        echo "Error al crear la tabla 'teams': " . $conn->error . "\n";
    }

    

    $players = "CREATE TABLE IF NOT EXISTS players (
        id INT AUTO_INCREMENT PRIMARY KEY,
        team_id INT,
        substitute BOOLEAN DEFAULT FALSE,
        name VARCHAR(100),
        nickname VARCHAR(100),
        epicgames_name VARCHAR(100),
        epicgames_id VARCHAR(100),
        steam_id VARCHAR(100),
        discord_id VARCHAR(100),
        peak INT,
        FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($players) === TRUE) {
        echo "Tabla 'players' creada correctamente.\n";
    } 
    else {
        echo "Error al crear la tabla 'players': " . $conn->error . "\n";
    }



    $staff = "CREATE TABLE IF NOT EXISTS staff (
        id INT AUTO_INCREMENT PRIMARY KEY,
        team_id INT,
        rol VARCHAR(100),
        name VARCHAR(100),
        age INT,
        email VARCHAR(100),
        telephone VARCHAR(20),
        discord_id VARCHAR(100),
        FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

    if ($conn->query($staff) === TRUE) {
        echo "Tabla 'staff' creada correctamente.\n";
    } 
    else {
        echo "Error al crear la tabla 'staff': " . $conn->error . "\n";
    }

?>