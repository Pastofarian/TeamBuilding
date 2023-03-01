<?php
   session_start();
   ?>

<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/success.css">
      <title>Merci pour votre inscription</title>
   </head>
   <body>
      <div class="container">
         <div class="card">
            <h1>Merci pour votre inscription</h1>
            <p>Nous avons bien reçu votre inscription. Nous vous recontacterons prochainement pour vous confirmer votre participation.</p>
            <img src="../Images/check.png" alt="checkmark">
            <?php
               // affiche les participants inscrit si il y en a 
               if (isset($_SESSION['Participants']) && !empty($_SESSION['Participants'])) {
                 echo '<p>Participants inscrits à cette activité :</p>';
                 echo '<ul>';
                 foreach ($_SESSION['Participants'] as $participant) {
                   echo '<li>' . $participant['nom'] . ' ' . $participant['prenom'] . '</li>';
                 }
                 echo '</ul>';
               }
               ?>
         </div>
      </div>
   </body>
</html>
