<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    
    include './controllers/pdo.php';
    
    $request = file_get_contents("php://input"); // gets the raw data
    $params = json_decode($request,true); // true for return as array
    
    $key = "keyword";

    $saved_key = $params[$key];

    $sql = $conexion->prepare('INSERT INTO log_searchs(search_query) VALUES(:saved_key)');
    $sql->bindParam(':saved_key', $saved_key);
    $sql->execute();
    
    
    if($params) $arr = array('result' => 'succes', 'saved' => $saved_key);
    else $arr = array('result' => 'error', 'message_error' => 'Invalid Request');

    echo json_encode($arr);
?>