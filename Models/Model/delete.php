<?php
include_once 'connection.php';
function deleteDB($id){
    $query = "DELETE FROM `Ingredient` WHERE id = :id";
    $query_params = array(
        ':id'=>$id
    );
    try {
        $stmt = $db->prepare($query); //change from getPDO() to $db
        $result = $stmt->execute($query_params);
    }
    catch(PDOException $ex){
        die("Failed query : " . $ex->getMessage());
    }
}