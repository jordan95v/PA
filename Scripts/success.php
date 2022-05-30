<?php
require "functions.php";
require "userFunction.php";

$pdo = connectDB();
$errors = [];
$code = rand(10000000, 99999999);

if (isset($_SESSION["stripe_ok"])) {
    $img = str_replace("\\", "/", dirname(__DIR__) . "/Images/Ticket" . createBarcode($code));
    $body = "Votre achat à été validé, vous retrouvez votre billet dans la section Mes Billets sur notre site !";
    $query = $pdo->prepare("INSERT INTO megalapin_ticket (user_id, film_id, ticket) VALUES (:id, :film, :ticket);");
    $query->execute(["id" => $_SESSION["id"], "film" => $_SESSION["film"], "ticket" => $img]);
    sendUserMail($_SESSION["email"], "lumiereswebsite@gmail.com", "Les Lumieres", "Confirmation d'achat", $body, $errors);
    updateUserLogs($pdo, $_SESSION["id"], "achat de billet");
    $_SESSION["sell"] = 1;
    unset($_SESSION["stripe_ok"]);
} else {
    $_SESSION["notAdmin"] = 1;
}
header("Location: ../index.php");

function createBarcode($code)
{
    $file_name = uniqid() . ".jpg";
    $img = imagecreate(500, 300);
    imagecolorallocate($img, 255, 255, 255);
    imagesetthickness($img, 10);
    $x = 20;

    for ($i = 0; $x < 500; $i++) {
        imageline($img, $x, 10, $x, 250, imagecolorallocate($img, 0, 0, 0));
        $x += rand(15, 30);
    }
    imagettftext($img, 25, 0, 130, 290, imagecolorallocate($img, 0, 0, 0), "../Static/Font/CaviarDreams.ttf", $code);
    imagepng($img, "../Images/Ticket/" . $file_name);
    return $file_name;
}
