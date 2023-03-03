<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start();
//include('../Models/read.php');
include('../Models/insert.php');
include('../Functions/functions.php');

$registration = 'Location: ../Views/registration.php';
$success = 'Location: ../Views/success.php';

// Récupère les activités
$activities = retrieveAllActivities();

// Boucle sur les activités pour le status sold out en fonction du nombre de participants
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


//Récupère les options de la table("table")
$resultPostcode = recupAllInfoDB("cp");
$resultLocomotion = recupAllInfoDB("Locomotion");
$resultDepartment = recupAllInfoDB("departement");
$resultActivity = recupAllInfoDB("activite");

// J'imagine que je pourrais créer un loop pour assigner ces variables... -_*
//Options pour le CP
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

$lastname = sanitize_input($_POST["lastname"]) ?? "";
$firstname = sanitize_input($_POST["firstname"]) ?? "";
$email = sanitize_input($_POST["email"]) ?? "";
$diner = isset($_POST["diner"]) ? "oui" : "non"; //Je préfere afficher oui ou non qu'un tinyint 
$postcode = sanitize_input($_POST["postcode"]) ?? "";
$locomotion = sanitize_input($_POST["locomotion"]) ?? "";
$department = sanitize_input($_POST["department"]) ?? "";
$activity = sanitize_input($_POST["activity"]) ?? "";
$_SESSION['formSubmitted'] = !empty($_POST) ? true : false;

$errors = [];
if (empty($lastname)) {
$errors[] = "Le nom est obligatoire";
}
if (empty($firstname)) {
$errors[] = "Le prénom est obligatoire";
}
if (empty($email)) {
  $errors[] = "L'email est obligatoire";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors[] = "L'email n'est pas valide";
} else {
  $result = recupAllInfoDB("employe");
  for ($i = 0; $i < count($result); $i++) {
    if ($email == $result[$i]['mail']) {
      $errors[] = "Votre email est déjà dans notre base de données"; 
      break;
    }
  }
}

if (empty($postcode) || !is_numeric($postcode)) {
$errors[] = "Le code postal n'est pas valide";
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

// rassemble les activités par participant
$activityId = isset($_POST['activity']) ? $_POST['activity'] : null;
$participants = retrieveParticipants($activityId);

// Vérifie si l'activité est sold out
$isSoldOut = ($activityId && retrieveParticipantsCount($activityId) >= retrieveActivityMaxParticipants($activityId));
$_SESSION['SoldOut'] = $isSoldOut;

if ($activity && !$isSoldOut && empty($errors)) {
    $employe_id = insertEmploye($lastname, $firstname, $email, $diner, $postcode, $locomotion, $department);
    insertActivity($activity, $employe_id);
    header($success); 
    exit;
} else {
    $_SESSION['errors'] = $errors;
    header($registration);
    exit;
}

$_SESSION['Participants'] = $participants;


//header($registration);

