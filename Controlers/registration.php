<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('../Models/read.php');

$resultCP = recupAllInfoDB("cp");
$resultLocomotion = recupAllInfoDB("Locomotion");
$resultDepartment = recupAllInfoDB("departement");
$resultActivity = recupAllInfoDB("activite");

//Option for the CP
// Impossible de créer une fonction pour appeler les options car pour le code postal il y a une colonne supplémentaire
$cp = '';
foreach ($resultCP as $row) {
  $cp .= '<option value="' . $row['id'] . '">' . $row['cp'] . ' ' . $row['nom'] . '</option>';
}
$_SESSION['CP'] = $cp;

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

