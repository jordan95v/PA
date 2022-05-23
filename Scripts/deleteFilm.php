<?php
require_once "functions.php";

$pdo = connectDB();

if (isAdmin($pdo)) {
    deleteImage($pdo, $_GET["id"], $errors);
    if (count($errors) != 0) {
        $query = $pdo->prepare("DELETE FROM groschien_film WHERE id=:id");
        $query->execute(["id" => $_GET["id"]]);
        $_SESSION["deletedFilm"] = 1;
    } else {
        $_SESSION['errors'] = $errors;
    }
    header("Location: ../index.php");
}

function deleteImage($pdo, $id, &$errors)
{
    $query = $pdo->prepare("SELECT image_path FROM groschien_film WHERE id=:id");
    $query->execute(["id" => $id]);
    $result = $query->fetch();
    if (!unlink($result["image_path"])) {
        $errors[] = "Impossible de supprimer l'image du film.";
    }
}
