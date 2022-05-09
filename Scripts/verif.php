<?php
require_once 'functions.php';

$pdo = connectDB();
$errors = [];

if (isset($_GET['cle']) && !empty($_GET['cle'])) 
{
    $cle = $_GET['cle'];
    $query=$pdo->prepare('SELECT * FROM petitchat_user WHERE cle=:cle');
    $query->execute(['cle'=>$cle]);

    if (!empty($query->fetch())) 
    {
        $query=$pdo->prepare('UPDATE petitchat_user SET statut=:statut WHERE cle=:cle');
        $query->execute(['cle'=>$cle, 'statut'=>1]);
        $_SESSION['confirm'] = 1;
    }
}
if (count($errors) != 0) {
    $_SESSION['errors'] = $errors;
}
header('Location: ../index.php');