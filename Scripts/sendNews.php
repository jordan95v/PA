<?php
require_once "functions.php";
require_once "userFunction.php";

if (empty($_POST["title"]) || empty($_POST["body"]) || count($_POST) != 2) {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
    die();
}

$title = htmlspecialchars(ucfirst(trim($_POST["title"])));
$body = htmlspecialchars(ucfirst(trim($_POST["body"])));
$pdo = connectDB();
$errors = [];

if (isAdmin($pdo)) {
    $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE newsletter=:news;");
    $query->execute(["news" => 1]);
    $result = $query->fetchAll();
    $emails = [];

    for ($i = 0; $i < count($result); $i++) {
        $emails[] = $result[$i]["email"];
    }

    sendNewsMail($title, $body, $emails, $errors);
    if (count($errors) != 0) {
        $_SESSION["errors"] = $errors;
        header("Location: ../index.php");
        die();
    }
    updateUserLogs($pdo, $_SESSION["id"], "send a newsletter");
    updateNews($pdo, $_SESSION["id"], $title, $body);
    $_SESSION['send'] = 1;
    header("Location: ../admin.php?type=newsletter");
} else {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
}
