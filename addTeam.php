<?php

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
        exit;
    }
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json');
    include 'conexion.php';

    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data || !isset($data['team'])) {
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos']);
        exit;
    }
    $t = $data['team'];
    $stmt = $conn->prepare(
        'INSERT INTO teams (name, color, image, youtube, twitch, twitter, instagram) VALUES (?,?,?,?,?,?,?)'
    );
    $stmt->bind_param(
        'sssssss',
        $t['name'],
        $t['color'],
        $t['image'],
        $t['youtube'],
        $t['twitch'],
        $t['twitter'],
        $t['instagram']
    );
    if (!$stmt->execute()) {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
        exit;
    }
    $team_id = $conn->insert_id;
    $stmt->close();

    echo json_encode(['status' => 'success', 'team_id' => $team_id]);
    
?>