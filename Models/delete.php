<?php

function deleteEmployee($id) {
    include('connection.php');
  
    try {
      $stmt = $db->prepare('DELETE FROM employe_activite WHERE fk_employe = ?');
      $stmt->execute(array($id));
  
      $stmt = $db->prepare('DELETE FROM employe WHERE id = ?');
      $stmt->execute(array($id));
  
    } catch (PDOException $ex) {
      die("Failed query : " . $ex->getMessage());
    }
  }
  
