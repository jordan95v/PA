<?php

require_once "functions.php";
require_once "userFunction.php";

if (
    empty($_POST["email"]) || empty($_POST["username"]) ||
    empty($_POST["password"]) || empty($_POST["passwordConfirm"]) ||
    empty($_POST["age"]) || empty($_POST["cgu"])
) {
    $_SESSION["empty"] = 1;
    header("Location: ../index.php");
    die();
}

$errors = [];
$pdo = connectDB();
$email = htmlspecialchars(strtolower(trim($_POST["email"])));
$username = htmlspecialchars(strtolower(trim($_POST["username"])));
$newsletter = ($_POST["newsletter"] === "on") ? 1 : 0;

checkUsername($username, $errors);
checkEmail($email, $errors);
checkPassword($_POST["password"], $_POST["passwordConfirm"], $errors);
checkEmailExist($email, $pdo, $errors);
checkUsernameExist($username, $pdo, $errors);

if (count($errors) != 0) {
    $_SESSION["errors"] = $errors;
    header("Location: ../index.php");
} else {
    $confirmKey = rand(1000000, 9000000);
    $query = $pdo->prepare("INSERT INTO petitchat_user (email, username, pwd, confirmKey, newsletter) VALUES (:email, :username, :pwd, :confirmKey, :newsletter);");
    $pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $query->execute(["email" => $email, "username" => $username, "pwd" => $pwd, "confirmKey" => $confirmKey, "newsletter" => $newsletter]);

    $title = "Mail de confirmation pour Les Lumieres !";
    $body = "Cliquez sur le lien pour confirmez votre email.<br><a href=\"http://leslumieres.site/Scripts/verif.php?confirmKey=" . $confirmKey . "\">Lien de confirmation</a>";
    sendUserMail($email, $title, $body, $errors);

    if (count($errors) != 0) {
        $_SESSION["errors"] = $errors;
    } else {
        $_SESSION["created"] = 1;
    }

    header("Location: ../index.php");
}
