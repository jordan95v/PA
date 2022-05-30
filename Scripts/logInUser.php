<?php
require "functions.php";

$errors = [];
$pdo = connectDB();

if (count($_POST) != 2) {
    $errors[] = "Veuillez réessayer.";
    $_SESSION["errors"] = $errors;
    header("Location: ../index.php");
    die();
}
connectUser($_POST["email"], $_POST["password"], $pdo, $errors);

if (count($errors) != 0) {
    $_SESSION["errors"] = $errors;
} else {
    updateUserLogs($pdo, $results["id"], "login");
    $_SESSION["logged"] = "Connexion réussi.";
}
header("Location: ../index.php");
