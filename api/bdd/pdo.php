<?php 
    
    $usr = 'root';
    $pwd = 'raygan123';
    $table = 'github_search';
    $host = 'localhost';

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