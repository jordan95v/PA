<?php 

require 'Classes/UserManager.php';
require 'Classes/DBManager.php';
require_once "functions.php";

$user = new UserManager($_POST);
$client = new DBManager();
if ($user->checkIntegrity($_POST)) {
    $client->addToDatabase($user);
    header("Location: ../index.php");
}

