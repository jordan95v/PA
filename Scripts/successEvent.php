<?php
require "functions.php";
require "userFunction.php";

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
    imagettftext($img, 15, 0, 10, 30, imagecolorallocate($img, 0, 0, 0), "../Static/Font/CaviarDreams.ttf", ucwords($name));
    imagettftext($img, 25, 0, 155, 290, imagecolorallocate($img, 0, 0, 0), "../Static/Font/CaviarDreams.ttf", $code);
    imagepng($img, "../Images/Ticket/" . $file_name);
    return $file_name;
}

$pdo = connectDB();
$errors = [];
$code = rand(10000000, 99999999);
$codeTicket = $code;
$date = $_GET["date"];
$time = $_GET["time"] . "h00";
$full_name = $_GET["event_name"] . " x" . $_GET["place"] . " " . $date . " " . $time;

if (isset($_SESSION["stripe_ok"])) {
    $img = "../Images/Ticket/" . createBarcode($code, $full_name);
    $body = '<html><body>Votre achat a ete valide, voici votre billet.</br><img src="cid:barcode"></body></html>';

    $query = $pdo->prepare("INSERT INTO mignonours_ticket_event (user_id, event_id, event_name, ticket, place, date, time, code) VALUES (:id, :event_id, :event_name,:ticket, :place, :date, :time, :code);");
    $query->execute(["id" => $_SESSION["id"], "event_id" => $_GET["event_id"], "event_name" => $_GET["event_name"], "ticket" => $img, "place" => $_GET["place"],"date" => $date, "time" => $time, "code" => $codeTicket]);

    sendTicket($_SESSION["email"], "Confirmation d'achat", $body, $img, $errors);
    updateUserLogs($pdo, $_SESSION["id"], "achat de billet");

    unset($_SESSION["stripe_ok"]);
    unset($_SESSION["event_id"]);
    unset($_SESSION["event_name"]);
    $_SESSION["sell"] = 1;
} else {
    $_SESSION["notAdmin"] = 1;
}
header("Location: ../index.php");
