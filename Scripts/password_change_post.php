<?php
require_once "functions.php";

$pdo = connectDB();
$errors = [];

if(isset($_POST['password']) && isset($_POST['password_repeat']) && isset($_POST['token'])){
    if(!empty($_POST['password']) && !empty($_POST['password_repeat']) && !empty($_POST['token'])){
        $password = htmlspecialchars($_POST['password']);
        $password_repeat = htmlspecialchars($_POST['password_repeat']);
        $token = htmlspecialchars($_POST['token']);

        $check = $pdo->prepare('SELECT * FROM petitchat_user WHERE token = ?');
        $check->execute(array($token));
        $row = $check->rowCount();

        if($row){
            if($password === $password_repeat){
                $password = password_hash($password, PASSWORD_DEFAULT);

                $update = $pdo->prepare('UPDATE petitchat_user SET pwd = ? WHERE token = ?');
                $update->execute(array($password, $token));

                $delete = $pdo->prepare('DELETE FROM grandegirafe_pwd_recover WHERE token_user = ?');
                $delete->execute(array($token));

                $_SESSION["passwdModify"] = 1;
                header("Location: ../index.php");
            }else{
                $errors [] = "Les mots de passes ne sont pas identiques";
                $_SESSION["errors"] = $errors;
                header("Location: ../index.php");
            }
        }else{
            $errors [] = "Compte non existant";
            $_SESSION["errors"] = $errors;
            header("Location: ../index.php");
        }
    }else{
        $errors [] = "Merci de renseigner un mot de passe";
        $_SESSION["errors"] = $errors;
        header("Location: ../index.php");
    }
}