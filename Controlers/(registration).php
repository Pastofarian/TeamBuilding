<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../Models/read.php');
include('../Models/insert.php');

$registration = 'Location: ../Views/registration.php';
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
//$_SESSION['Activity'] = $activity;

$lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
$firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$diner = isset($_POST["diner"]) ? "oui" : "non"; //tinyint
$postcode = isset($_POST["postcode"]) ? intval($_POST["postcode"]) : null;
$locomotion = isset($_POST["locomotion"]) ? intval($_POST["locomotion"]) : null;
$department = isset($_POST["department"]) ? intval($_POST["department"]) : null;
$activity = isset($_POST["activity"]) ? intval($_POST["activity"]) : null;

$employe_id = insertEmploye($lastname, $firstname, $email, $diner, $postcode, $locomotion, $department);

// if ($activity) {
//   insertActivity($activity, $employe_id);
// }

// Retrieve all activities
$activities = retrieveAllActivities();

// Process each activity to get participants count and sold out status
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


$activityId = isset($_POST['activity']) ? $_POST['activity'] : null;
$participants = retrieveParticipants($activityId);


$soldOut = ($activityId && retrieveParticipantsCount($activityId) >= retrieveActivityMaxParticipants($activityId));


$_SESSION['Participants'] = $participants;
$_SESSION['SoldOut'] = $soldOut;

// $activityOptions = array();
// $activities = retrieveAllActivities();
// foreach ($activities as $activity) {
//   $count = retrieveParticipantsCount($activity['id']);
//   $max = $activity['nbmax'];
//   $soldOut = ($count >= $max) ? " - COMPLET" : "";
//   $activityOptions[] = array(
//     'id' => $activity['id'],
//     'nom' => $activity['nom'],
//     'count' => $count,
//     'max' => $max,
//     'soldOut' => $soldOut
//   );
// }

// $activityId = isset($_POST['activity']) ? $_POST['activity'] : null;
// $participants = retrieveParticipants($activityId);
// $soldOut = ($activityId && retrieveParticipantsCount($activityId) >= retrieveActivityMaxParticipants($activityId));

// // Store variables in session
// $_SESSION['ActivityOptions'] = $activityOptions;
// $_SESSION['Participants'] = $participants;
// $_SESSION['SoldOut'] = $soldOut;



header($registration);

// $employe_id = insertEmploye($_POST["lastname"], $_POST["firstname"], $_POST["email"], $_POST["diner"], $_POST["postcode"], $_POST["locomotion"], $_POST["department"]);

// insertActivity($_POST["activity"], $employe_id);



// array(8) { ["name"]=> string(3) "Doe" ["firstname"]=> string(4) "John" ["email"]=> string(20) "john.doe@outlook.com" ["postcode"]=> string(1) "1" ["locomotion"]=> string(1) "1" ["department"]=> string(1) "2" ["activity"]=> string(1) "4" ["souper"]=> string(2) "on" } 

