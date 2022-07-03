<?php
require_once "functions.php";

$pdo = connectDB();

if(isset($_GET['u']) && isset($_GET['token']) && !empty($_GET['u']) && !empty($_GET['token'])){
    $u = htmlspecialchars(base64_decode($_GET['u']));
    $token = htmlspecialchars(base64_decode($_GET['token']));

    $check = $pdo->prepare('SELECT * FROM grandegirafe_pwd_recover WHERE token_user = ? AND token = ?');
    $check->execute(array($u, $token));
    $row = $check->rowCount();

    if($row){
        $get = $pdo->prepare('SELECT token FROM petitchat_user WHERE token = ?');
        $get->execute(array($u));
        $data_u = $get->fetch();

        if(hash_equals($data_u['token'], $u)){
            header('Location: ../password_change.php?u='.base64_encode($u));
        }else{
            $_SESSION["badAccount"] = 1;
            header("Location: index.php");
        }
    }else {
        $_SESSION["badAccount"] = 1;
        header("Location: ../index.php");
    }
}else{
    $_SESSION["badLink"] = 1;
    header("Location: ../index.php");
}