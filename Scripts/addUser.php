<?php

require_once 'functions.php';
require_once 'userFunction.php';

if (
    empty($_POST['email']) && empty($_POST['username']) &&
    empty($_POST['password']) && empty($_POST['passwordConfirm']) &&
    empty($_POST['age']) && empty($_POST['cgu']) && count($_POST) != 6
) {
    die();
}

$errors = [];
$pdo = connectDB();

$email = strtolower(trim($_POST['email']));
$username = strtolower(trim($_POST['username']));

checkUsername($username, $errors);
checkEmail($email, $errors);
checkPassword($_POST['password'], $_POST['passwordConfirm'], $errors);
checkEmailExist($email, $pdo, $errors);
checkUsernameExist($username, $pdo, $errors);

if (count($errors) != 0) {
    $_SESSION['errors'] = $errors;
    header('Location: ../index.php');
} else {
    $cle = rand(1000000, 9000000);
    $query = $pdo->prepare("INSERT INTO petitchat_user (email, username, pwd, cle) VALUES (:email, :username, :pwd, :cle);");
    $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query->execute(["email" => $email, "username" => $username, "pwd" => $pwd, "cle"=>$cle]);

    sendConfirmMail($email, $cle, $errors);

    if (count($errors) != 0) {
        $_SESSION['errors'] = $errors;
    }
    else 
    {
        $_SESSION['created'] = 1;
    }
    
    header('Location: ../index.php');
}