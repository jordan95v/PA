<?php
require "functions.php";
require "userFunction.php";

$pdo = connectDB();
$errors = [];
$code = rand(10000000, 99999999);

if (isset($_SESSION["stripe_ok"])) {
    $img = str_replace("\\", "/", dirname(__DIR__) . "/Images/Ticket/" . createBarcode($code, $_SESSION["film_name"]));
    $body = '<html><body>Votre achat à été validé, voici votre ticket.</br><img src="cid:barcode"></body></html>';

    $query = $pdo->prepare("INSERT INTO megalapin_ticket (user_id, film_id, film_name, ticket) VALUES (:id, :film_id, :film_name,:ticket);");
    $query->execute(["id" => $_SESSION["id"], "film_id" => $_SESSION["film_id"], "film_name" => $_SESSION["film_name"], "ticket" => $img]);

    sendTicket($_SESSION["email"], "Confirmation d'achat", $body, $img, $errors);
    updateUserLogs($pdo, $_SESSION["id"], "achat de billet");

    $_SESSION["sell"] = 1;
    unset($_SESSION["stripe_ok"]);
    unset($_SESSION["film_id"]);
    unset($_SESSION["film_name"]);
} else {
    $_SESSION["notAdmin"] = 1;
}
header("Location: ../index.php");

function createBarcode($code, $name)
{
    $file_name = uniqid() . ".jpg";
    $img = imagecreate(500, 300);
    imagecolorallocate($img, 255, 255, 255);
    imagesetthickness($img, 10);
    $x = 20;

    for ($i = 0; $x < 500; $i++) {
        imageline($img, $x, 40, $x, 250, imagecolorallocate($img, 0, 0, 0));
        $x += rand(15, 30);
    }
    imagettftext($img, 25, 0, 130, 30, imagecolorallocate($img, 0, 0, 0), "../Static/Font/CaviarDreams.ttf", ucwords($name));
    imagettftext($img, 25, 0, 150, 290, imagecolorallocate($img, 0, 0, 0), "../Static/Font/CaviarDreams.ttf", $code);
    imagepng($img, "../Images/Ticket/" . $file_name);
    return $file_name;
}
