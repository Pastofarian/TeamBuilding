<?php

function updateEmployee($id, $nom, $prenom, $mail, $cp, $locomotion, $departement, $souper) {
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

//updateEmployee(1, "Doe", "Johnny", "johndoe@test.be", 2, 3, 1, "oui");