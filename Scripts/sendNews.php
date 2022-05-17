<?php
require_once "functions.php";
require_once "userFunction.php";

if (empty($_POST["title"]) || empty($_POST["body"]) || count($_POST) != 2) {
    $_SESSION["notAdmin"] = 1;
    header("Location: index.php");
}

$title = ucfirst(trim($_POST["title"]));
$body = ucfirst(trim($_POST["body"]));
$pdo = connectDB();
$errors = [];

if (isAdmin($pdo)) {
    $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE newsletter=:news");
    $query->execute(["news" => 1]);
    $result = $query->fetchAll();

    for ($i = 0; $i < count($result); $i++) {
        $email = $result[$i]["email"];
        sendMail($email, $title, $body, $errors);

        if (count($errors) != 0) {
            $_SESSION["errors"] = $errors;
            header("Location: ../index.php");
        }
    }
    $_SESSION['send'] = 1;
    header("Location: ../index.php");
} else {
    $_SESSION["notAdmin"] = 1;
    header("Location: index.php");
}
