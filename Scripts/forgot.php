<?php
require_once "functions.php";
require_once "userFunction.php";

$pdo = connectDB();

if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);

    $check = $pdo->prepare('SELECT token FROM petitchat_user WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();

    if ($row) {
        $token = bin2hex(openssl_random_pseudo_bytes(24));
        $token_user = $data['token'];
        $insert = $pdo->prepare('INSERT INTO grandegirafe_pwd_recover(token_user, token) VALUES (?,?)');
        $insert->execute(array($token_user, $token));
        $link = 'https://leslumieres.site/Scripts/recover.php?u=' . base64_encode($token_user) . '&token=' . base64_encode($token);
        $title = utf8_decode("Mot de passe oublié Les Lumières !");
        $body = "Cliquez sur le lien pour changer votre mot de passe.<br><a href='$link'>Lien mot de passe oublié</a>";
        sendUserMail($email, $title, $body, $errors);
        header("Location: ../index.php");
    } else {
        $_SESSION["badAccount"] = 1;
        header("Location: ../index.php");
    }
}
