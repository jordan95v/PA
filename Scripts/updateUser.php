<?php

require_once "functions.php";
require_once "userFunction.php";

if (
    empty($_POST["email"]) || empty($_POST["username"])
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
checkEmailExist($email, $pdo, $errors, $_SESSION["token"]);
checkUsernameExist($username, $pdo, $errors, $_SESSION["token"]);

if (isConnected($pdo)) {
    if (count($errors) != 0) {
        $_SESSION["errors"] = $errors;
        header("Location: ../index.php");
    } else {
        $query = $pdo->prepare("UPDATE petitchat_user SET email=:email, username=:username, newsletter=:news, head=:head, eyes=:eyes, mouth=:mouth WHERE token=:token;");
        $query->execute([
            "email" => $email,
            "username" => $username,
            "token" => $_SESSION["token"],
            "news" => $newsletter,
            "head" => $_POST["head"],
            "eyes" => $_POST["eyes"],
            "mouth" => $_POST["mouth"]
        ]);
    }
    if (!empty($_POST["oldPassword"]) && !empty($_POST["password"]) && !empty($_POST["passwordConfirm"])) {
        $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE token=:token;");
        $query->execute(["token" => $_SESSION["token"]]);
        $user = $query->fetch();
        if (checkPassword($_POST["password"], $_POST["passwordConfirm"], $errors)) {
            if (password_verify($_POST["oldPassword"], $user["pwd"])) {
                $pwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $query = $pdo->prepare("UPDATE petitchat_user SET pwd=:pwd WHERE token=:token;");
                $query->execute(["pwd" => $pwd, "token" => $_SESSION["token"]]);
            }
        }
    }
    if (count($errors) != 0) {
        $_SESSION["errors"] = $errors;
        header("Location: ../index.php");
    } else {
        $_SESSION["updated"] = 1;
        $_SESSION["email"] = $email;
        $_SESSION["username"] = $username;
        updateUserLogs($pdo, $_SESSION["id"], 'updated profile.');
        header("Location: ../index.php");
    }
} else {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
}
