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

//Option for the Locomotion
$locomotion = '';
foreach ($resultLocomotion as $row) {
  $locomotion .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}
$_SESSION['Locomotion'] = $locomotion;

//Option for the Department
$department = '';
foreach ($resultDepartment as $row) {
  $department .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}
$_SESSION['Department'] = $department;

//Option for the Activity
$activity = '';
foreach ($resultActivity as $row) {
  $activity .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}
$_SESSION['Activity'] = $activity;

insertEmploye($_POST["lastname"], $_POST["firstname"], $_POST["email"], $_POST["diner"], $_POST["postcode"], $_POST["locomotion"], $_POST["department"]);


// insertDB($_POST["name"], $_POST["firstname"], $_POST["email"], $_POST["email"], $data1);
// header("Location: " . $login);

// var_dump($_POST);

// array(8) { ["name"]=> string(3) "Doe" ["firstname"]=> string(4) "John" ["email"]=> string(20) "john.doe@outlook.com" ["postcode"]=> string(1) "1" ["locomotion"]=> string(1) "1" ["department"]=> string(1) "2" ["activity"]=> string(1) "4" ["souper"]=> string(2) "on" } 