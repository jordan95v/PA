<?php

require_once 'functions.php';
require_once 'userFunction.php';

$errors = [];
$pdo = connectDB();

$email = strtolower(trim($_POST['email']));
$username = strtolower(trim($_POST['username']));

checkUsername($username, $errors);
checkEmail($email, $errors);
checkEmailExist($email, $pdo, $errors, $_SESSION['token']);
checkUsernameExist($username, $pdo, $errors, $_SESSION['token']);

if (count($errors) != 0) {
    $_SESSION['errors'] = $errors;
    header('Location: ../index.php');
} else {
    $query = $pdo->prepare("UPDATE petitchat_user SET email=:email, username=:username WHERE token=:token");
    $query->execute([
        'email' => $email,
        'username' => $username,
        'token' => $_SESSION['token']
    ]);
}
if (!empty($_POST['oldPassword']) && !empty($_POST['password']) && !empty($_POST['passwordConfirm'])) {
    $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE token=:token");
    $query->execute(['token' => $_SESSION['token']]);
    $user = $query->fetch();
    if (checkPassword($_POST['password'], $_POST['passwordConfirm'], $errors)) {
        if (password_verify($_POST['oldPassword'], $user['pwd'])) {
            $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = $pdo->prepare("UPDATE petitchat_user SET pwd=:pwd WHERE token=:token");
            $query->execute(['pwd' => $pwd, 'token' => $_SESSION['token']]);
        }
    }
}
if (count($errors) != 0) {
    $_SESSION['errors'] = $errors;
    header('Location: ../index.php');
} else {
    $_SESSION['updated'] = 1;
    header('Location: ../index.php');
}
