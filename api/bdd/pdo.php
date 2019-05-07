<?php 
    include "./config.php";
    try {
        $conexion = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    } catch(PDOException $e) {
        echo json_encode($e -> getMessage());
    }
?>