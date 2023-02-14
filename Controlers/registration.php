<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../Models/read.php');
include('../Models/insert.php');

$resultPostcode = recupAllInfoDB("cp");
$resultLocomotion = recupAllInfoDB("Locomotion");
$resultDepartment = recupAllInfoDB("departement");
$resultActivity = recupAllInfoDB("activite");

//Option for the CP
// Impossible de créer une fonction pour appeler les options car pour le code postal il y a une colonne supplémentaire puis il faudrait 2 paramètres, ça fait beaucoup.
$cp = '';
foreach ($resultPostcode as $row) {
  $cp .= '<option value="' . $row['id'] . '">' . $row['cp'] . ' ' . $row['nom'] . '</option>';
}
$_SESSION['postcode'] = $cp;

//Locomotion's options
$locomotion = '';
foreach ($resultLocomotion as $row) {
  $locomotion .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}
$_SESSION['Locomotion'] = $locomotion;

//Department's options
$department = '';
foreach ($resultDepartment as $row) {
  $department .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}
$_SESSION['Department'] = $department;

//Activity's options
$activity = '';
foreach ($resultActivity as $row) {
  $activity .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}
$_SESSION['Activity'] = $activity;

$lastname = isset($_POST["lastname"]);
$firstname = isset($_POST["firstname"]);
$email = isset($_POST["email"]);
$diner = isset($_POST["diner"]) ? "oui" : "non";
$postcode = isset($_POST["postcode"]);
$locomotion = isset($_POST["locomotion"]);
$department = isset($_POST["department"]);
$activity = isset($_POST["activity"]);

$employe_id = insertEmploye($lastname, $firstname, $email, $diner, $postcode, $locomotion, $department);

insertActivity($activity, $employe_id);

// $employe_id = insertEmploye($_POST["lastname"], $_POST["firstname"], $_POST["email"], $_POST["diner"], $_POST["postcode"], $_POST["locomotion"], $_POST["department"]);

// insertActivity($_POST["activity"], $employe_id);



// array(8) { ["name"]=> string(3) "Doe" ["firstname"]=> string(4) "John" ["email"]=> string(20) "john.doe@outlook.com" ["postcode"]=> string(1) "1" ["locomotion"]=> string(1) "1" ["department"]=> string(1) "2" ["activity"]=> string(1) "4" ["souper"]=> string(2) "on" } 

