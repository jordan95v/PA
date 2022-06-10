<?php
require_once "functions.php";

if (
    empty($_POST["title"]) || empty($_POST["type"]) ||
    empty($_FILES["file"]) || !isset($_POST["date-debut"]) ||
    !isset($_POST["date-fin"]) || empty($_POST["desc"])
    count($_POST) != 5 || empty($_FILES)
) {
    die();
}

$target_dir = "../Images/Movies/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$errors = [];
$pdo = connectDB();

if (isAdmin($pdo))
{
    if (count($errors) != 0)
    {
        $_SESSION["errors"] = $errors;
        header("Location: ../index.php");
    }
    else {
        if (filmExists($pdo, $title, $errors))
        {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                makeFiligrane($target_file);
                $query = $pdo->prepare("INSERT INTO groschien_film (image_path, title, genre, maker, actors, featured) VALUES (:image_path, :title, :genre, :maker, :actors, :featured);");
                $query->execute(["image_path"=>$target_file, "title"=>$title, "genre"=>$_POST["genre"], "maker"=>$maker, "actors"=>$actor, "featured"=>$featured]);
                $_SESSION["upload"] = 1;
                header("Location: ../index.php");
            } else {
                $errors[] = "Impossible d\"uploader le fichier.";
            }
        }
        if (count($errors) != 0)
        {
            $_SESSION["errors"] = $errors;
            header("Location: ../index.php");
        } 
    }
}