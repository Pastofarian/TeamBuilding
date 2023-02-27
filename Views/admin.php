<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
  if(!$_SESSION['loggedIn'])
    header("Location: ../Views/logAdmin.php"); //redirige vers la page de log

include("../Models/read.php");
include("../Models/update.php");
?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../CSS/admin.css">
      <title>Administration</title>
   </head>
   <body>
      <main role="main">
      <form action="../Controlers/admin.php" method="POST">
    <button class="logout-button" type="submit" name="logout">Logout</button>
</form>
        <h1>Listing Participants</h1>
      <table>
  <thead>
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Mail</th>
      <th>Code postal / Ville</th>
      <th>Locomotion</th>
      <th>Département</th>
      <th>Souper</th>
      <th>Update/Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $employees = retrieveAllEmployees();
    foreach ($employees as $row): ?>
      <tr>
        <td><?= $row['nom'] ?></td>
        <td><?= $row['prenom'] ?></td>
        <td><?= $row['mail'] ?></td>
        <td><?= $row['cp'] ?></td>
        <td><?= $row['locomotion'] ?></td>
        <td><?= $row['departement'] ?></td>
        <td><?= $row['souper'] ?></td>
        <td>
        <form method="POST" action="../Controlers/admin.php">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">
  <input type="hidden" name="nom" value="<?= $row['nom'] ?>">
  <input type="hidden" name="prenom" value="<?= $row['prenom'] ?>">
  <input type="hidden" name="mail" value="<?= $row['mail'] ?>">
  <input type="hidden" name="cp" value="<?= $row['cp'] ?>">
  <input type="hidden" name="locomotion" value="<?= $row['locomotion'] ?>">
  <input type="hidden" name="departement" value="<?= $row['departement'] ?>">
  <input type="hidden" name="souper" value="<?= $row['souper'] ?>">
  <button type="submit">Update</button>
</form> 

<form method="POST" action="../Controlers/admin.php">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">
  <input type="hidden" name="action" value="delete">
  <button type="submit">Delete</button>
</form>

        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<table>
  <thead>
    <tr>
      <th>Activité</th>
      <th>Participants</th>
      <th>Nom et Prénom des participants</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $activities = retrieveAllActivities();

    foreach ($activities as $activity) {
        $activityId = $activity['id'];
        $activityName = $activity['nom'];
        $activityMaxParticipants = $activity['nbmax'];
        $participantsCount = retrieveParticipantsCount($activityId);
        $participants = retrieveParticipants($activityId);
    ?>
      <tr>
        <td><?= $activityName ?></td>
        <td><?= $participantsCount ?>/<?= $activityMaxParticipants ?></td>
        <td>
          <?php if ($participantsCount > 0) { ?>
            <ul>
              <?php foreach ($participants as $participant) { ?>
                <li><?= $participant['prenom'] ?> <?= $participant['nom'] ?></li>
              <?php } ?>
            </ul>
          <?php } else { ?>
            <p>Aucun participant inscrit pour cette activité.</p>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

         <h1 class="form-title">Ajouter un nouvel administrateur</h1>
         <form action="../Controlers/admin.php" method="POST" class="login-form">
            <p>
               <label for="email" class="form-label">Adresse e-mail du nouvel admin</label>
               <input type="email" name="MailNewAdmin" autocomplete="on" required="required" class="form-input">
            </p>
            <p>
               <label for="pass" class="form-label">Mot de passe du nouvel admin</label>
               <input type="password" name="PassNewAdmin" required="required" class="form-input">
            </p>
            <p>
               <label for="pass" class="form-label">Répétez le mot de passe</label>
               <input type="password" name="PassNewAdmin2" required="required" class="form-input">
            </p>
            <p>
               <input type="submit" value="Envoyer" id="submit" class="form-button">
            </p>
         </form>
         <?php
            error_reporting(0);
              if (isset($_SESSION["checkPassword"])){
                echo $_SESSION["checkPassword"];
              }
               echo'<pre>';
               if (isset($_SESSION["checkEmail"])){
                echo $_SESSION["checkEmail"];
              }
               echo'<pre>';
               if (isset($_SESSION["matchPassword"])){
                echo $_SESSION["matchPassword"];
              }
              if (isset($_SESSION["checkDuplicates"])){
                echo $_SESSION["checkDuplicates"];
              }
               echo'<pre>';
              //session_destroy();
         ?>
      </main>
   </body>
</html>