<?php 
    include "./config.php";
    try {
        $conexion = new PDO("mysql:host=$host;dbname=$table;charset=utf8", $usr, $pwd);
        
        if($conexion) {
            $status = true;
        } else {
            $status;
        }
        
    } catch(PDOException $e) {
        echo $e -> getMessage();
    }
?>