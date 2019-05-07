<?php 
    
    include "config.php";

    try {
        $conexion = new PDO("mysql:host=$HOST;dbname=$DATABASE;charset=utf8", $USERNAME, $PASSWORD);
        
        if($conexion) {
            $status = true;
        } else {
            $status;
        }
        
    } catch(PDOException $e) {
        echo $e -> getMessage();
    }
?>