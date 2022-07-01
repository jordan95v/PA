<?php
require_once "functions.php";

$pdo = connectDB();

if(!isset($_POST["ticket"]) || empty($_POST["ticket"])){
    die();
}

$query = $pdo->prepare('SELECT statut FROM megalapin_ticket WHERE code=:code');
$query->execute(["code" => $_POST["ticket"]]);

$statut = $query->fetch();

if($statut["statut"] == 0){
    $query = $pdo->prepare('UPDATE megalapin_ticket SET statut = 1 WHERE code=:code');
    $query->execute(["code" => $_POST["ticket"]]);
    $_SESSION["valid"] = 1;
    header("Location: ../admin.php?type=ticket");
}elseif($statut["statut"] == 1){
    $_SESSION["invalid"] = 1;
    header("Location: ../admin.php?type=ticket");
}

