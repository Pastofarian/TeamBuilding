<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../Models/read.php");
?>
<!DOCTYPE html>
<html lang="fr">
<html>
  <head>
  <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/registration.css">
    <title>Inscription journée du personnel</title>
  </head>
  <body>
    <button class="admin-button"><a href="logAdmin.php">Admin</a></button>
    <h1>Inscription journée du personnel</h1>
    <form action="../Controlers/registration.php" method="POST">
      <label for="lastname">Votre nom :</label>
      <input type="text" name="lastname"><br><br>
      <label for="firstname">Votre prénom :</label>
      <input type="text" name="firstname"><br><br>
      <label for="email">Votre mail :</label>
      <input type="email" name="email"><br><br>
      <label for="postcode">Votre code postal :</label>
      <select name="postcode">
        <option value=""></option>
          <?php 
            session_start();
            echo $_SESSION['postcode']; 
          ?>
      </select><br><br>
      <label for="locomotion">Votre moyen de locomotion pour arriver :</label>
      <select name="locomotion">
        <option value=""></option>
          <?php 
            echo $_SESSION['Locomotion'];
          ?>
      </select><br><br>
      <label for="department">Votre département au sein de la société :</label>
      <select name="department">
        <option value=""></option>
          <?php 
            echo $_SESSION['Department'];
          ?>
      </select><br><br>
      <label for="activity">Votre activité choisie :</label>
      <select name="activity">
        <option value=""></option>
          <?php 
            // echo $_SESSION['Activity'];
            $activities = retrieveAllActivities();
            foreach ($activities as $activity) {
              $count = retrieveParticipantsCount($activity['id']);
              $max = $activity['nbmax'];
              $soldOut = ($count >= $max) ? " - COMPLET" : "";
              echo '<option value="' . $activity['id'] . '">' . $activity['nom'] . ' : ' . $count . '/' . $max . $soldOut . '</option>';
            }
          ?>
      </select><br><br>
      <label for="diner">Participerez-vous au souper au soir ?
<input type="checkbox" name="diner">
</label><br><br>
<?php
  $activityId = isset($_POST['activity']) ? $_POST['activity'] : null;
  $participants = retrieveParticipants($activityId);
  if ($soldOut) {
    echo '<p>Désolé, cette activité est complète.</p>';
  } else {
    if ($participants !== null) {
      echo '<p>Participants inscrits à cette activité :</p>';
      echo '<ul>';
      foreach ($participants as $participant) {
        echo '<li>' . $participant['nom'] . ' ' . $participant['prenom'] . '</li>';
      }
      echo '</ul>';
    }

    echo '<input type="submit" value="Envoyer">';
  }
?>
    </form>
  </body>
</html>
