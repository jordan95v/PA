<?php
require "functions.php";

$pdo = connectDB();

// Check si l'utilisateur est admin.
if (!isAdmin($pdo)) {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
}

// Check si l'user envoie bien quelque chose.
if (empty($_POST["genre"])) {
    $_SESSION["empty"] = 1;
    header("Location: ../admin.php?type=genre");
    die();
}

// Checker ce que l'user envoie grâce à une regex.
// Regex -> Sert a vérifier qu'une chaîne de caractères correspont bien au pattern donnée, \w+ -> au moins 1 ou plusieurs char.
// C'est pas un trim qu'il faut pour vérifier si ça contient bien des lettres, le trim marche pas si la string envoyer est que un seul espace.
if (!preg_match("/\w+/", $_POST["genre"])) {
    $_SESSION["emptyChar"] = 1;
    header("Location: ../admin.php?type=genre");
    die();
}

$genre = htmlspecialchars(trim($_POST["genre"]));

if (!checkGenreExists($pdo, $genre)) {
    // Ajout en BDD.
    $query = $pdo->prepare("INSERT INTO gelar_herisson_genre (genre) VALUES (:genre);");
    $query->execute(["genre" => $genre]);
    $_SESSION['genre'] = 1;
} else {
    $_SESSION["genreExists"] = 1;
}
header("Location: ../admin.php?type=genre");
