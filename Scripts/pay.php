<?php

use Stripe\Stripe;

require "functions.php";
require "stripe/init.php";

if (
    empty($_POST["date"]) || empty($_POST["time"]) ||
    empty($_POST["place"]) || empty($_POST["film_id"]) ||
    empty($_POST["film_name"])
) {
    $_SESSION["empty"] = 1;
    header("Location: ../index.php");
    die();
}

$pdo = connectDB();
$time = [10, 14, 18, 22];

$date_now = time(); //current timestamp
$date_convert = strtotime($_POST["date"]);
$filmName = utf8_decode(htmlspecialchars(str_replace('\'', '', $_POST["film_name"])));
$filmId = htmlspecialchars($_POST["film_id"]);

if ($date_now > $date_convert) {
    $_SESSION["badDate"] = 1;
    header("Location: ../index.php");
    die();
} elseif (!in_array($_POST["time"], $time)) {
    $_SESSION["badDate"] = 1;
    header("Location: ../index.php");
    die();
} else {
    if (isConnected($pdo)) {
        Stripe::setApiKey("sk_test_51L53G8AzApjgsM9WZJl6ELzVSmw0nPrE0f1pBJxQPJz7HSDGqIOVsTZYAUpnSgcrIOrB1GqTAd5qoBAv6bmhOKQk00QDVr8jDR");
        header("Content-Type: application/json");

        $domain = "https://leslumieres.site/";

        $checkout_session = \Stripe\Checkout\Session::create([
            "line_items" => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                "price" => "price_1L53zcAzApjgsM9WGe82vWKQ",
                "quantity" => $_POST["place"],
            ]],
            "mode" => "payment",
            "success_url" => $domain . "Scripts/success.php?date=" . $_POST["date"] . "&time=" . $_POST["time"] . "&film_id=" . $filmId . "&film_name=" . $filmName . "&place=" . $_POST["place"],
            "cancel_url" => $domain . "Scripts/cancel.php",
        ]);
        $_SESSION["stripe_ok"] = 1;
        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    } else {
        $_SESSION["notLogged"] = 1;
        header("Location: ../index.php");
    }
}
