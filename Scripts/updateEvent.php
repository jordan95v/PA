<?php

require "functions.php";

if(
    empty($_POST["title"]) || empty($_POST["maker"]) ||
    empty($_POST["actors"]) || empty($_POST["content"])
){
    $_SESSION["empty"] = 1;
    header("Location: ../admin.php?type=event");
    die();
}

$pdo = connectDB();
$newTitle = $_POST["title"];
$newMaker = $_POST["maker"];
$newActors = $_POST["actors"];
$newContent = nl2br(htmlspecialchars($_POST["content"]));

if(isAdmin($pdo)){

    $newEvent = $pdo->prepare("UPDATE gigaecureil_event SET title=?, maker=?, actors=?, content=? WHERE id = ?");
    $newEvent->execute(array($newTitle, $newMaker, $newActors, $newContent, $_GET["id"]));
    //updateUserLogs($pdo, $_SESSION["id"], "updated film: " . getTitle($pdo, $_GET["id"]) . ".");
    $_SESSION["modifEvent"] = 1;
    header("Location: ../index.php");
}