<?php
require "functions.php";
$pdo = connectDB();


if (
    empty($_POST["genre"]) || empty($_GET["id"])
) {
    $_SESSION["empty"] = 1;
    header("Location: ../admin.php?type=genre");
    die();
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

// Regex pour vérifier si il y a bien un id.
if (!preg_match("/\d+/", $_GET["id"])) {
    $_SESSION["emptyChar"] = 1;
    header("Location: ../admin.php?type=genre");
    die();
}

$genre = htmlspecialchars(trim($_POST["genre"]));

if (isAdmin($pdo)) {
    // Requête pour modifier le genre en BDD.
    $query = $pdo->prepare("UPDATE gelar_herisson_genre SET genre=:genre WHERE id=:id;");
    $query->execute(["genre" => $genre, "id" => $_GET["id"]]);
    $_SESSION["modifyGenre"] = 1;
    header("Location: ../admin.php?type=genre");
}
