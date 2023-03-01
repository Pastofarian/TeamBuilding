<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../Functions/functions.php");
include("../Models/insert.php");

include("../Models/delete.php");
include("../Models/update.php");

$admin = "Location: ../Views/admin.php";
$logAdmin = "Location: ../Views/logAdmin.php";

if (isset($_POST['logout'])) {
  session_destroy();
  header($logAdmin);
  exit;
}

// Delete participant
if (isset($_POST['delete_participant'])) {
  $participant_id = $_POST['participant_id'];
  deleteEmployee($participant_id);
  header($admin);
  exit;
}



if (isset($_POST['update_participant']) && $_POST['update_participant'] == 'update_participant') {
  $participantId = $_POST['participant_id'];
  $participantFirstName = $_POST['participant_first_name'];
  $participantLastName = $_POST['participant_last_name'];
  $participantEmail = $_POST['participant_email'];
  $participantPostalCode = $_POST['postcode'];
  $participantTransportationMode = $_POST['locomotion'];
  $participantDepartment = $_POST['department'];
  $participantDinnerPreference = $_POST['diner'];
  
  updateEmployee($participantId, $participantLastName, $participantFirstName, $participantEmail, $participantPostalCode, $participantTransportationMode, $participantDepartment, $participantDinnerPreference);
  
  header($admin);
  exit;
}

//this works///////////////////////////
if (isset($_POST['action']) && $_POST['action'] == 'update_activity') {
    $activityId = $_POST['activity_id'];
    $activityName = $_POST['activity_name'];
    $activityMaxParticipants = $_POST['activity_max_participants'];
    updateActivity($activityId, $activityName, $activityMaxParticipants);
    header($admin);
    exit;
}
///////////////////////////////


$data1 = $_POST["PassNewAdmin"];
unset($_POST["PassNewAdmin"]); //Efface les traces
$data2 = $_POST["PassNewAdmin2"];
unset($_POST["PassNewAdmin2"]);

$_SESSION["checkEmpty"] = checkEmpty($_POST);
$_SESSION["matchPassword"] = MatchPassword($data1, $data2);
$_SESSION["checkEmail"] = checkEmail($_POST["MailNewAdmin"]);
$_SESSION["checkPassword"] = checkPassword($data1);
$_SESSION["checkDuplicates"] = duplicates($_POST["MailNewAdmin"]);

$data1 = password_hash($data1,PASSWORD_BCRYPT); //écrase data1 avec password crypté

if(
    !empty($_SESSION["checkEmpty"]) || 
    !empty($_SESSION["matchPassword"]) || 
    !empty($_SESSION["checkEmail"]) ||
    !empty($_SESSION["checkPassword"]) ||
    !empty($_SESSION["checkDuplicates"])
    ) {
}else{
    insertNewAdmin($_POST["MailNewAdmin"], $data1);
}
header($admin);
//header('Location: ../Models/update.php');
exit();

// var_dump($data1);

//session_destroy();
