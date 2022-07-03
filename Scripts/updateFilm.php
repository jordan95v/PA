<?php
require_once "functions.php";

function getTitle($pdo, $id)
{
    $query = $pdo->prepare("SELECT title FROM groschien_film WHERE id=:id;");
    $query->execute(["id" => $id]);
    return $query->fetch()["title"];
}

if (
    empty($_POST["title"]) || empty($_POST["genre"]) ||
    empty($_POST["maker"]) || empty($_POST["actors"]) ||
    empty($_POST["desc"]) || empty($_POST["time"])
) {
    $_SESSION["empty"] = 1;
    header("Location: ../index.php");
    die();
}

$pdo = connectDB();
$title = htmlspecialchars(strtolower($_POST["title"]));
$maker = htmlspecialchars(strtolower($_POST["maker"]));
$actors = htmlspecialchars(strtolower($_POST["actors"]));
$info = htmlspecialchars(strtolower($_POST["desc"]));
$featured = ($_POST["featured"] === "on") ? 1 : 0;

if (isAdmin($pdo)) {
    $query = $pdo->prepare("UPDATE groschien_film SET title=:title, maker=:maker, genre=:genre, actors=:actors, info=:info, featured=:featured, duration=:duration WHERE id=:id;");
    $query->execute(["title" => $title, "maker" => $maker, "genre" => $_POST["genre"], "actors" => $actors, "info" => $info, "featured" => $featured, "duration" => $_POST["time"], "id" => $_GET["id"]]);
    updateUserLogs($pdo, $_SESSION["id"], "updated film: " . getTitle($pdo, $_GET["id"]) . ".");
    $_SESSION["modified"] = 1;
    header("Location: ../admin.php?type=film");
}
