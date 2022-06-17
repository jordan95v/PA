<?php
require_once "functions.php";

function deleteImage($pdo, $id)
{
    $query = $pdo->prepare("SELECT image_path FROM groschien_film WHERE id=:id;");
    $query->execute(["id" => $id]);
    $result = $query->fetch();
    unlink($result["image_path"]);
}

$pdo = connectDB();

if (isAdmin($pdo)) {
    deleteImage($pdo, $_GET["id"]);
    $query = $pdo->prepare("DELETE FROM groschien_film WHERE id=:id;");
    $query->execute(["id" => $_GET["id"]]);
    updateUserLogs($pdo, $_SESSION["id"], "deleted film" . $_GET["id"] . ".");
    $_SESSION["deletedFilm"] = 1;
    header("Location: ../admin.php?type=film");
}


