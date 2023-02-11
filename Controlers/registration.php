<?php
session_start();
include('../Models/readCP.php');

$result = recupAllInfoCP();


// echo "test2";
//var_dump($result);

$cp;
foreach ($result as $row) {
  $cp .= $row['cp'] . ' ' . $row['nom'];
  $cp .= '</option>';
}

$_SESSION['CP'] = $cp;
