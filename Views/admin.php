<?php
   session_start();
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   
   //Evite l'accès direct par URL
   if (!$_SESSION['loggedIn']) {
       header("Location: ../Views/logAdmin.php");
       exit;
   }
   
   include("../Models/read.php");
   include("../Models/update.php");
   
   $employees = retrieveAllEmployees();
   $activities = retrieveAllActivities();

//    foreach ($employees as $row){
//     echo $row['locomotion'];
//    }
   
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
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
  <?php foreach ($employees as $row): ?>
    <tr>
      <form method="POST" action="../Controlers/admin.php">
        <input type="hidden" name="participant_id" value="<?= $row['id'] ?>">
        <td><input type="text" name="participant_last_name" value="<?= $row['nom'] ?>"></td>
        <td><input type="text" name="participant_first_name" value="<?= $row['prenom'] ?>"></td>
        <td><input type="email" name="participant_email" value="<?= $row['mail'] ?>"></td>
        <td>
          <select name="postcode">
            <option value="<?= $row['cp'] ?>"></option>
            <?php echo $_SESSION['postcode']; ?>
          </select>
        </td>
        <td>
          <select name="locomotion">
            <option value="<?= $row['locomotion'] ?>"></option>
            <?php echo $_SESSION['Locomotion']; ?>
          </select>
        </td>
        <td>
          <select name="department">
            <option value="<?=$row['departement']?>"></option>
            <?php echo $_SESSION['Department']; ?>
          </select>
        </td>
        <td><input type="checkbox" name="diner"></td>
        <td>
          <button type="submit" name="update_participant" value="update_participant">Modifier</button>
          <button type="submit" name="delete_participant" value="delete_participant">Supprimer</button>
        </td>
      </form>
    </tr>
  <?php endforeach; ?>
</tbody>

         </table>
         <h1>Mise à jour des activités</h1>
         <table>
            <thead>
               <tr>
                  <th>Nom de l'activité</th>
                  <th>Max Participants</th>
                  <th>Modifier</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($activities as $activity): ?>
               <tr>
                  <form method="POST" action="../Controlers/admin.php">
                     <input type="hidden" name="activity_id" value="<?= $activity['id'] ?>">
                     <td><input type="text" name="activity_name" value="<?= $activity['nom'] ?>"></td>
                     <td><input type="number" name="activity_max_participants" value="<?= $activity['nbmax'] ?>"></td>
                     <td><button type="submit" name="action" value="update_activity">Modifier</button></td>
                  </form>
               </tr>
               <?php endforeach; ?>
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
         //affiche les erreurs (empty, pas valide, ...) seulement si le form a été complété
         if ($_SESSION['formSubmitted'] && isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            //error_reporting(0);
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
            }
         ?>
      </main>
   </body>
</html>
