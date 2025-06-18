<?php

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $host = "localhost";
    $user = "root";
    $pass = "";
    $nameDB = "manager";

    $conn = new MySQLi($host, $user, $pass, $nameDB);

    if ($conn -> connect_errno){
        die("Conexión fallida");
    }

    $conn -> set_charset("utf8");

?>