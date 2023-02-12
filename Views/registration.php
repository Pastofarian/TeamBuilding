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
      <select id="locomotion" name="locomotion">
        <option value=""></option>
          <?php 
            echo $_SESSION['Locomotion'];
          ?>
      </select><br><br>
      <label for="department">Votre département au sein de la société :</label>
      <select id="department" name="department">
        <option value=""></option>
          <?php 
            echo $_SESSION['Department'];
          ?>
      </select><br><br>
      <label for="activity">Votre activité choisie :</label>
      <select id="activity" name="activity">
        <option value=""></option>
          <?php 
            echo $_SESSION['Activity'];
          ?>
      </select><br><br>
      <label for="diner">Participerez-vous au souper au soir ?</label>
      <input type="checkbox" name="diner"><br><br>
      <input type="submit" value="Envoyer">
    </form>
  </body>
</html>
