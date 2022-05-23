<?php
require_once "functions.php";

if (
    empty($_POST["title"]) || empty($_POST["genre"]) ||
    empty($_POST["maker"]) || empty($_POST["actors"]) ||
    empty($_POST["desc"])
) {
    $_SESSION["empty"] = 1;
    header("Location: ../index.php");
    die();
}

$pdo = connectDB();
$title = strtolower($_POST["title"]);
$maker = strtolower($_POST["maker"]);
$actors = strtolower($_POST["actors"]);
$info = strtolower($_POST["desc"]);
$featured = ($_POST["featured"] === "on") ? 1 : 0;

if (isAdmin($pdo)) {
    $query = $pdo->prepare("UPDATE groschien_film SET title=:title, maker=:maker, genre=:genre, actors=:actors, info=:info, featured=:featured WHERE id=:id");
    $query->execute(["title" => $title, "maker" => $maker, "genre" => $_POST["genre"], "actors" => $actors, "info" => $info, "featured" => $featured, "id" => $_GET["id"]]);
    $_SESSION["modified"] = 1;
    header("Location: ../index.php");
}
