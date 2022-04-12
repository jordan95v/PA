<?php
require 'functions.php';

$errors = [];
$pdo = connectDB();

if (count($_POST) != 2) {
    $errors[] = 'Veuillez réessayer';
    $_SESSION['errors'] = $errors;
    header('Location: ../index.php');
}
connectUser($_POST['email'], $_POST['password'], $pdo, $errors);

if (count($errors) != 0) {
    $_SESSION['errors'] = $errors;
}
header('Location: ../index.php');