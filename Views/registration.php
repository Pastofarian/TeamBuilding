<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../Models/read.php");
?>
<!DOCTYPE html>
<html lang="fr">
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
    if (!empty($_SESSION['ActivityOptions'])) {
      foreach ($_SESSION['ActivityOptions'] as $option) {
        echo '<option value="' . $option['id'] . '">' . $option['nom'] . ' : ' . $option['count'] . '/' . $option['max'] . $option['soldOut'] . '</option>';
      }
    }
  ?>
</select><br><br>
      <label for="diner">Participerez-vous au souper au soir ?
        <input type="checkbox" name="diner">
        </label><br><br>

<?php
// vérifie si l'activité n'est pas sold out
if (isset($_SESSION['SoldOut']) && $_SESSION['SoldOut']) {
  echo '<p>Désolé, cette activité est complète.</p>';
} else {
  // affiche les participants inscrit si il y en a 
  if (isset($_SESSION['Participants']) && !empty($_SESSION['Participants'])) {
    echo '<p>Participants inscrits à cette activité :</p>';
    echo '<ul>';
    foreach ($_SESSION['Participants'] as $participant) {
      echo '<li>' . $participant['nom'] . ' ' . $participant['prenom'] . '</li>';
    }
    echo '</ul>';
  }
  
  // Affiche le bouton envoyer si pas sold out
  echo '<input type="submit" value="Envoyer">';
}
?>

</form>
</body>
</html>
