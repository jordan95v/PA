<?php
require_once "functions.php";

$pdo = connectDB();

if (isAdmin($pdo)) {
    deleteImage($pdo, $_GET["id"]);
    $query = $pdo->prepare("DELETE FROM gigaecureil_event WHERE id=:id;");
    $query->execute(["id" => $_GET["id"]]);
    //updateUserLogs($pdo, $results["id"], "deleted film" . $_GET["id"] . ".");
    $_SESSION["deletedEvent"] = 1;
    header("Location: ../admin.php?type=event");
}

function deleteImage($pdo, $id)
{
    $query = $pdo->prepare("SELECT image_event FROM gigaecureil_event WHERE id=:id;");
    $query->execute(["id" => $id]);
    $result = $query->fetch();
    unlink($result["image_event"]);
}
