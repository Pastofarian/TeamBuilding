<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

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
  $participant_id = $_POST['id'];
  deleteEmployee($participant_id);
  header($admin);
  exit;
}

// Update participant
if (isset($_POST['update_participant']) && $_POST['update_participant'] == 'update_participant') {
  $id = $_POST['id'];
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $postcode = getCpId($_POST['postcode']);
  $locomotion = getLocomotionId($_POST['locomotion']);
  $department = getDepartmentId($_POST['department']);
  $diner = $_POST['diner'];
  $activity = getActivityId($_POST['activity']);
  //var_dump($_POST);
  updateParticipant($id, $lastName, $firstName, $email, $postcode, $locomotion, $department, $diner, $activity);
  header($admin);
  exit;
}

// Update activity
if (isset($_POST['action']) && $_POST['action'] == 'update_activity') {
  $activityId = $_POST['activity_id'];
  $activityName = $_POST['activity_name'];
  $activityMaxParticipants = $_POST['activity_max_participants'];
  updateActivity($activityId, $activityName, $activityMaxParticipants);
  header($admin);
  exit;
}

// Insert new admin
if (isset($_POST["PassNewAdmin"])) {
  $data1 = $_POST["PassNewAdmin"];
  unset($_POST["PassNewAdmin"]);
}

if (isset($_POST["PassNewAdmin2"])) {
  $data2 = $_POST["PassNewAdmin2"];
  unset($_POST["PassNewAdmin2"]);
}

if (isset($_POST["MailNewAdmin"])) {
  $email = $_POST["MailNewAdmin"];
  unset($_POST["MailNewAdmin"]);
}


// $data1 = isset($_POST["PassNewAdmin"]) ? $_POST["PassNewAdmin"] : "";
// $data2 = isset($_POST["PassNewAdmin2"]) ? $_POST["PassNewAdmin2"] : "";
// $email = isset($_POST["MailNewAdmin"]) ? $_POST["MailNewAdmin"] : "";

$_SESSION["checkEmpty"] = checkEmpty($_POST);
$_SESSION["matchPassword"] = MatchPassword($data1, $data2);
$_SESSION["checkEmail"] = checkEmail($email);
$_SESSION["checkPassword"] = checkPassword($data1);
$_SESSION["checkDuplicates"] = duplicates($email);
$_SESSION['adminFormSubmitted'] = !empty($_POST) ? true : false;


$data1 = password_hash($data1,PASSWORD_BCRYPT); // Écrase data1 avec le mot de passe crypté

if (
    !empty($_SESSION["checkEmpty"]) || 
    !empty($_SESSION["matchPassword"]) || 
    !empty($_SESSION["checkEmail"]) ||
    !empty($_SESSION["checkPassword"]) ||
    !empty($_SESSION["checkDuplicates"])
) {
} else {
    insertNewAdmin($email, $data1);
 }
// echo $email;
// echo $data1;
header($admin);
exit();

// $cpId = getCpId($cp);
// $locomotionId = getLocomotionId($locomotion);
// $departmentId = getDepartmentId($departement);