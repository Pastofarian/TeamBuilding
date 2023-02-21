<?php

function recupAllInfoDB($table){

  include('connection.php');

  $query = "SELECT * FROM $table";
  $query_params = array();
  try
  {
      $stmt = $db->prepare($query);
      $result = $stmt->execute($query_params);
  }
  catch(PDOException $ex){
      die("Failed query : " . $ex->getMessage());
  }
  $result = $stmt->fetchall();
  return (!empty($result)) ? $result: 'NULL';
}

// $result = recupAllInfoDB("admin");
// var_dump($result);
// echo("test");
//var_dump(recupAllInfoAdmin());

