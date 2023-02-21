<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../Functions/functions.php");
include("../Models/insert.php");

$admin = 'Location: ../Views/admin.php';
$data1 = $_POST["PassNewAdmin"];
unset($_POST["PassNewAdmin"]); //éfface les traces
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
// var_dump($data1);

//session_destroy();
