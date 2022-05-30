<?php
require_once "functions.php";

$pdo = connectDB();
$errors = [];

if (isset($_GET["confirmKey"]) && !empty($_GET["confirmKey"])) {
    $confirmKey = $_GET["confirmKey"];
    $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE confirmKey=:confirmKey AND statut=:statut;");
    $query->execute(["confirmKey" => $confirmKey, "statut" => 0]);

    if (!empty($query->fetch())) {
        $query = $pdo->prepare("UPDATE petitchat_user SET statut=:statut WHERE confirmKey=:confirmKey;");
        $query->execute(["confirmKey" => $confirmKey, "statut" => 1]);
        $_SESSION["confirm"] = 1;
    } else {
        die();
    }
}
if (count($errors) != 0) {
    $_SESSION["errors"] = $errors;
}
header("Location: ../index.php");
