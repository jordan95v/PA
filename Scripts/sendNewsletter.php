<?php
require_once 'functions.php';


if (
    empty($_POST['title']) && empty($_POST['body']) &&
    count($_POST) != 2
) {
    die();
}

$title = ucwords($_POST['title']);
$body = ucfirst($_POST['body']);
$pdo = connectDB();
$errors = [];

if (isAdmin($pdo))
{
    $query = $pdo->prepare('SELECT * FROM petitchat_user WHERE newsletter:=newsletter');
    $query->execute(['newsletter'=>1]);
    $result = $query->fetchAll();

    for ($i=0; $i < count($result); $i++) { 
        $email = $result[$i]['email'];
        sendMail($email, $title, $body, $errors)

        if (count($errors) != 0)
        {
            $_SESSION['errors'] = 1;
            header('Location: ../index.php');
        }
    }

    $_SESSION['send'] = 1;
    header('Location: ../index.php');
}