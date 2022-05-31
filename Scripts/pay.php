<?php

use Stripe\Stripe;

require "functions.php";
require "stripe/init.php";

$pdo = connectDB();
$time = [10, 14, 18, 22];

print_r($_POST);
$date_now = time(); //current timestamp
$date_convert = strtotime($_POST["date"]);

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

        $domain = "http://localhost";

        $checkout_session = \Stripe\Checkout\Session::create([
            "line_items" => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                "price" => "price_1L53zcAzApjgsM9WGe82vWKQ",
                "quantity" => 1,
            ]],
            "mode" => "payment",
            "success_url" => $domain . "/PA/Scripts/success.php?date=" . $_POST["date"] . "&time=" . $_POST["time"] . "&film_id=" . $_POST["film_id"] . "&film_name=" . $_POST["film_name"],
            "cancel_url" => $domain . "/PA/Scripts/cancel.php",
        ]);
        $_SESSION["stripe_ok"] = 1;
        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    } else {
        $_SESSION["notLogged"] = 1;
        header("Location: ../index.php");
    }
}
