<?php

//this works
function updateParticipant($id, $nom, $prenom, $mail, $cp, $locomotion, $departement, $souper) {
  include("connection.php");
  try {
      $stmt = $db->prepare('UPDATE employe SET nom = ?, prenom = ?, mail = ?, fk_cp = ?, fk_locomotion = ?, fk_departement = ?, souper = ? WHERE id = ?');
      $stmt->execute([$nom, $prenom, $mail, $cp, $locomotion, $departement, $souper, $id]);
      $stmt = null;
      $pdo = null;
  } catch (PDOException $e) {
      die("Error occurred while updating employee: " . $e->getMessage());
  }
}

// function updateParticipant($id, $nom, $prenom, $mail, $cp, $locomotion, $departement, $diner) {
//   include('connection.php');
  
//   try {
//     $cpId = getCpId($cp);
//     $locomotionId = getLocomotionId($locomotion);
//     $departmentId = getDepartmentId($departement);
    
//     $stmt = $db->prepare('UPDATE employe SET nom = ?, prenom = ?, mail = ?, fk_cp = ?, fk_locomotion = ?, fk_departement = ?, souper = ? WHERE id = ?');
//     $stmt->execute(array($nom, $prenom, $mail, $cpId, $locomotionId, $departmentId, $diner, $id));
  
//   } catch (PDOException $ex) {
//     die("Error occurred while updating employee: " . $ex->getMessage());
//   }
// }

function getDepartmentId($name) {
  switch ($name) {
    case 'Comptabilité':
      return 1;
    case 'R&D':
      return 2;
    case 'ICT':
      return 3;
    case 'HR':
      return 4;
    default:
      return null;
  }
}

function getCpId($cp) {
  switch ($cp) {
    case '1300 Wavre':
      return 1;
    case '1301 Bierge':
      return 2;
    case '1310 La Hulpe':
      return 3;
    default:
      return null;
  }
}

function getLocomotionId($name) {
  switch ($name) {
    case 'Voiture':
      return 1;
    case 'Train':
      return 2;
    case 'Bus':
      return 3;
    case 'Vélo':
      return 4;
    default:
      return null;
  }
}


function updateActivity($activityId, $activityName, $activityMaxParticipants) {
  include("connection.php");
  try {
      $stmt = $db->prepare('UPDATE activite SET nom = ?, nbmax = ? WHERE id = ?');
      $stmt->execute([$activityName, $activityMaxParticipants, $activityId]);
      $stmt = null;
      $pdo = null;
  } catch (PDOException $e) {
      die("Error occurred while updating activity: " . $e->getMessage());
  }
}

//updateParticipant(1, "Doe", "John", "johndoe@test.be", 2, 3, 1, "oui");