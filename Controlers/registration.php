<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../Models/read.php');
include('../Models/insert.php');

// Récupère les activités
$activities = retrieveAllActivities();

// boucle sur les activités pour le status sold out en fonction du nombre de participants
$activityOptions = [];
foreach ($activities as $activity) {
$count = retrieveParticipantsCount($activity['id']);
$max = $activity['nbmax'];
$soldOut = ($count >= $max) ? " - COMPLET" : "";
$activityOptions[] = [
'id' => $activity['id'],
'nom' => $activity['nom'],
'count' => $count,
'max' => $max,
'soldOut' => $soldOut
];
}
$_SESSION['ActivityOptions'] = $activityOptions;

$registration = 'Location: ../Views/registration.php';
$success = 'Location: ../Views/success.php';

//Récupère les options de la table("table")
$resultPostcode = recupAllInfoDB("cp");
$resultLocomotion = recupAllInfoDB("Locomotion");
$resultDepartment = recupAllInfoDB("departement");
$resultActivity = recupAllInfoDB("activite");

//Options pour le CP
// J'imagine que je pourrais créer un loop pour assigner ces variables mais ça marche comme ça
$cp = '';
foreach ($resultPostcode as $row) {
  $cp .= '<option value="' . $row['id'] . '">' . $row['cp'] . ' ' . $row['nom'] . '</option>';
}
$_SESSION['postcode'] = $cp;

//Option pour locomotion
$locomotion = '';
foreach ($resultLocomotion as $row) {
  $locomotion .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}
$_SESSION['Locomotion'] = $locomotion;

//Option du département
$department = '';
foreach ($resultDepartment as $row) {
  $department .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}
$_SESSION['Department'] = $department;

//Options des activités
$activity = '';
foreach ($resultActivity as $row) {
  $activity .= '<option value="' . $row['id'] . '">' . $row['nom'] . '</option>';
}

$lastname = $_POST["lastname"] ?? "";
$firstname = $_POST["firstname"] ?? "";
$email = $_POST["email"] ?? "";
$diner = isset($_POST["diner"]) ? "oui" : "non"; //Je préfere afficher oui ou non qu'un tinyint 
$postcode = $_POST["postcode"] ?? "";
$locomotion = $_POST["locomotion"] ?? "";
$department = $_POST["department"] ?? "";
$activity = $_POST["activity"] ?? "";

// if(empty) pour eviter les erreurs "failed query"
$errors = [];
if (empty($lastname)) {
  $errors[] = "Le nom est obligatoire";
}
if (empty($firstname)) {
  $errors[] = "Le prénom est obligatoire";
}
if (empty($email)) {
  $errors[] = "L'email est obligatoire";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //doc php : Check if the variable $email is a valid email address:
  $errors[] = "l'email n'est pas valide";
}
if (empty($postcode) || !is_numeric($postcode)) {
  $errors[] = "Le mot de passe n'est pas valide";
}
if (empty($locomotion) || !is_numeric($locomotion)) {
  $errors[] = "Le moyen de locomotion n'est pas valide";
}
if (empty($department) || !is_numeric($department)) {
  $errors[] = "Le département n'est pas valide";
}
if (empty($activity) || !is_numeric($activity)) {
  $errors[] = "L'activité n'est pas valide";
}

// Si $errors on reste sur la page
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header($registration);
    exit;
  }

$employe_id = insertEmploye($lastname, $firstname, $email, $diner, $postcode, $locomotion, $department);

if ($activity) {
  insertActivity($activity, $employe_id);
}

// rassemble l'activité par participant
$activityId = isset($_POST['activity']) ? $_POST['activity'] : null;
$participants = retrieveParticipants($activityId);

// Vérifie si l'activité est sold out
$soldOut = ($activityId && retrieveParticipantsCount($activityId) >= retrieveActivityMaxParticipants($activityId));

$_SESSION['Participants'] = $participants;
$_SESSION['SoldOut'] = $soldOut;

// Redirige vers la page d'inscription
header("Location: ../Views/registration.php");
//var_dump($_SESSION['ActivityOptions']);
exit();


