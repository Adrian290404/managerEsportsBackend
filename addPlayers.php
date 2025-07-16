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
    header('Content-Type: application/json; charset=utf-8');

    include 'conexion.php';

    $body = json_decode(file_get_contents('php://input'), true);
    if (!isset($body['players']) || !is_array($body['players'])) {
        http_response_code(400);
        echo json_encode(['status'=>'error','message'=>'Debes enviar "players" como array']);
        exit;
    }

    $sql = 'INSERT INTO players
        (team_id,name,nickname,epicgames_name,epicgames_id,steam_id,discord_id,peak)
    VALUES (?,?,?,?,?,?,?,?)';
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['status'=>'error','message'=>'Error en prepare: '.$conn->error]);
        exit;
    }

    $types = 'isssssss';
    $errors = [];
    $inserted = 0;

    foreach ($body['players'] as $idx => $p) {
        $required = ['team_id','name','nickname','epicgames_name','epicgames_id','steam_id','discord_id','peak'];
        foreach ($required as $f) {
            if (!isset($p[$f])) {
                $errors[] = "Jugador #$idx faltó campo '$f'";
                continue 2;
            }
        }

        $stmt->bind_param(
            $types,
            $p['team_id'],
            $p['name'],
            $p['nickname'],
            $p['epicgames_name'],
            $p['epicgames_id'],
            $p['steam_id'],
            $p['discord_id'],
            $p['peak']
        );

        if (!$stmt->execute()) {
            $errors[] = "Jugador '{$p['name']}' error: ".$stmt->error;
        } else {
            $inserted++;
        }
    }

    $stmt->close();


    if (count($errors) === 0) {
        echo json_encode(['status'=>'success','inserted'=>$inserted]);
    } else {
        http_response_code(207);
        echo json_encode(['status'=>'partial','inserted'=>$inserted,'errors'=>$errors]);
    }