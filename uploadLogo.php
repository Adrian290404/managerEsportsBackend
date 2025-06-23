<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    if ($_SERVER['REQUEST_METHOD']==='OPTIONS') exit;

    $targetDir = __DIR__ . '/assets/';
    if (!is_dir($targetDir)){
        mkdir($targetDir, 0755, true);
    }

    if (!isset($_FILES['logo']) || $_FILES['logo']['error']!==UPLOAD_ERR_OK) {
        http_response_code(400);
        exit(json_encode(['status'=>'error','message'=>'Sin fichero']));
    }

    $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg','jpeg','png','gif'])) {
        http_response_code(400);
        exit(json_encode(['status'=>'error','message'=>'Extensión no permitida']));
    }

    $newName = uniqid('logo_',true).".".$ext;
    if (move_uploaded_file($_FILES['logo']['tmp_name'], $targetDir.$newName)) {
        echo json_encode(['status'=>'success','path'=>'assets/'.$newName]);
    } 
    else {
        http_response_code(500);
        exit(json_encode(['status'=>'error','message'=>'No se pudo mover']));
    }
?>