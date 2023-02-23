<?php

function updateEmployee($id, $nom, $prenom, $mail, $cp, $locomotion, $departement, $souper) {
    try {
      $db = new PDO('mysql:host=localhost;dbname=TeamBuilding;charset=utf8mb4', 'username', 'password');
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
      $stmt = $db->prepare("UPDATE employe SET nom=?, prenom=?, mail=?, fk_cp=?, fk_locomotion=?, fk_departement=?, souper=? WHERE id=?");
      $stmt->execute([$nom, $prenom, $mail, $cp, $locomotion, $departement, $souper, $id]);
  
      return true;
    } catch (PDOException $e) {
      echo 'Failed query : ' . $e->getMessage();
      return false;
    }
  }
  