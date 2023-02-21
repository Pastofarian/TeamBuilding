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
            session_start();
            error_reporting(0);
               echo $_SESSION["checkPassword"];
               echo'<pre>';
               echo $_SESSION["checkEmail"];
               echo'<pre>';
               echo $_SESSION["matchPassword"];
               echo'<pre>';
               echo $_SESSION["checkDuplicates"];
               echo'<pre>';
              //session_destroy();
         ?>
      </main>
   </body>
</html>
