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
    include("conexion.php");

    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['id']) || !is_numeric($input['id'])) {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'ID inválido']);
        exit;
    }

    $teamId = (int) $input['id'];

    $stmt = $conn->prepare(
        "SELECT id, name, color, image, youtube, twitch, twitter, instagram
        FROM teams
        WHERE id = ?"
    );
    $stmt->bind_param("i", $teamId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = [
                'id'        => $row['id'],
                'name'      => $row['name'],
                'color'     => $row['color'],
                'image'     => $row['image'],
                'youtube'   => $row['youtube'],
                'twitch'    => $row['twitch'],
                'twitter'   => $row['twitter'],
                'instagram' => $row['instagram'],
            ];
            break;
        }
    }

    echo json_encode($data);

?>