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

function retrieveAllEmployees() {
  include('connection.php');

  $query = 'SELECT e.id, e.nom, e.prenom, e.mail, e.souper, CONCAT(cp.cp, " ", cp.nom) AS cp, L.nom AS locomotion, d.nom AS departement FROM employe e
  INNER JOIN cp ON e.fk_cp = cp.id
  INNER JOIN Locomotion L ON e.fk_locomotion = L.id
  INNER JOIN departement d ON e.fk_departement = d.id
  ORDER BY e.id ASC';
  $query_params = array();
  try {
      $stmt = $db->prepare($query);
      $stmt->execute($query_params);
      $employees = $stmt->fetchAll();
      return $employees;
  } catch (PDOException $ex) {
      die("Failed query : " . $ex->getMessage());
  }
}

function retrieveAllActivities() {
  include('connection.php');
  try {
    $query = "SELECT * FROM activite";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC); //Fetches the remaining rows from a result set
    return $activities;
  } catch(PDOException $ex) {
    die("Failed query: " . $ex->getMessage());
  }
}

function retrieveParticipantsCount($activityId) {
  include('connection.php');
  try {
    $query = "SELECT COUNT(*) as count FROM employe_activite WHERE fk_activite = :activityId";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":activityId", $activityId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'];
  } catch(PDOException $ex) {
    die("Failed query: " . $ex->getMessage());
  }
}

function retrieveParticipants($activityId) {
  include('connection.php');
  
  $query = "SELECT e.nom, e.prenom
            FROM employe e
            JOIN employe_activite ea ON e.id = ea.fk_employe
            WHERE ea.fk_activite = :activityId";
  $query_params = array(':activityId' => $activityId);
  
  try {
    $stmt = $db->prepare($query);
    $stmt->execute($query_params);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $ex) {
    die("Failed query : " . $ex->getMessage());
  }
  
  return (!empty($result)) ? $result : NULL;
}

function retrieveActivityMaxParticipants($activityId) {
  include('connection.php');
  
  $query = "SELECT nbmax FROM activite WHERE id = :activityId";
  $query_params = array(':activityId' => $activityId);
  
  try {
    $stmt = $db->prepare($query);
    $stmt->execute($query_params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $ex) {
    die("Failed query : " . $ex->getMessage());
  }
  
  return (!empty($result)) ? $result['nbmax'] : NULL;
}

//$employees = retrieveAllEmployees();
//var_dump($employees);


 
// echo "test";
//var_dump(recupAllInfoAdmin());
// echo retrieveActivityMaxParticipants("2");
// echo retrieveParticipantsCount("2");
