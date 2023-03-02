<?php

function deleteEmployee($id) {
  include('connection.php');

  try {
    // Efface l'entrée de employe_activite
    $stmt = $db->prepare('DELETE FROM employe_activite WHERE fk_employe = ?');
    $stmt->execute(array($id));

    // Efface l'entrée de employe
    $stmt = $db->prepare('DELETE FROM employe WHERE id = ?');
    $stmt->execute(array($id));

  } catch (PDOException $ex) {
    die("Failed query : " . $ex->getMessage());
  }
}

  
