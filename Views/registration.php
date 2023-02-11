<!DOCTYPE html>
<html lang="en">
<html>
  <head>
  <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../CSS/registration.css">
    <title>Inscription journée du personnel</title>
  </head>
  <body>
    <h1>Inscription journée du personnel</h1>
    <form action="">
      <label for="nom">Votre nom :</label>
      <input type="text" id="nom" name="nom"><br><br>
      <label for="prenom">Votre prénom :</label>
      <input type="text" id="prenom" name="prenom"><br><br>
      <label for="mail">Votre mail :</label>
      <input type="email" id="mail" name="mail"><br><br>
      <label for="code_postal">Votre code postal :</label>
      <select id="code_postal" name="code_postal">
        <option value=""></option>
        <?php
        session_start();
        echo $_SESSION['CP'];
        ?>
        <!-- add options for different postal codes -->
      </select><br><br>
      <label for="locomotion">Votre moyen de locomotion pour arriver :</label>
      <select id="locomotion" name="locomotion">
        <option value=""></option>
        <!-- add options for different modes of transportation -->
      </select><br><br>
      <label for="department">Votre département au sein de la société :</label>
      <select id="department" name="department">
        <option value=""></option>
        <!-- add options for different departments -->
      </select><br><br>
      <label for="activity">Votre activité choisie :</label>
      <select id="activity" name="activity">
        <option value=""></option>
        <!-- add options for different activities -->
      </select><br><br>
      <label for="souper">Participerez-vous au souper au soir ?</label>
      <input type="checkbox" id="souper" name="souper"><br><br>
      <input type="submit" value="Envoyer">
    </form>
  </body>
</html>
