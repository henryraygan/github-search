<?php 
    include "./bdd/pdo.php";

    $request = file_get_contents("php://input"); // gets the raw data
    $params = json_decode($request,true); // true for return as array
    
    $key = "keyword";

    $saved_key = $params[$key];

    $sql = $conexion->prepare('INSERT INTO log_searchs(search_query) VALUES(:saved_key)');
    $sql->bindParam(':saved_key', $saved_key);
    $sql->execute();
    
    if($sql) $arr = array('result' => 'succes', 'saved' => $saved_key);    

    echo json_encode($arr);
?>