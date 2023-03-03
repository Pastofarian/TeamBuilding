<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../CSS/logAdmin.css">
      <title>Administration</title>
   </head>
   <body>
      <button class="registration-button"><a href="registration.php">Retour inscription</a></button>
      <h1 class="form-title">Log in</h1>
      <form action="../Controlers/logAdmin.php" method="POST" class="login-form">
         <?php
            session_start();
            if(isset($_SESSION["logError"])){
               echo "<p style='color: red'>" . $_SESSION["logError"] . "</p>";
               unset($_SESSION["logError"]);
            }
            ?>
         <p>
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="logMail" autocomplete="on" required="required" class="form-input">
         </p>
         <p>
            <label for="pass" class="form-label">Entrez votre mot de passe *</label>
            <input type="password" name="logPass" required="required" class="form-input">
         </p>
         <p style="font-size:12px"> (*) Le mot de passe doit comporter : 8 caractères minimum, 1 chiffre minimum, 1 majuscule minimum, 1 minuscule minimum</p>
         <p>
         <p>
            <input type="submit" value="Envoyer" class="form-button">
         </p>
      </form>
   </body>
</html>
