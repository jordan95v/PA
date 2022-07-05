<?php
require 'functions.php';
$pdo = connectDB();

// Regex pour vérifier si il y a bien un id.
if (!preg_match("/\d+/", $_GET["id"])) {
    $_SESSION["emptyChar"] = 1;
    header("Location: ../admin.php?type=genre");
    die();
}

$id = $_GET['id'];
if (isAdmin($pdo)) {
    // Requête pour supprimer le genre en BDD.
    $query = $pdo->prepare("DELETE FROM gelar_herisson_genre WHERE id=:id;");
    $query->execute(["id" => $id]);
    $_SESSION["deletedGenre"] = 1;
    header('Location: ../admin.php?type=genre');
} else {
    $_SESSION["notAdmin"] = 1;
    header('Location: ../index.php');
    die;
}
