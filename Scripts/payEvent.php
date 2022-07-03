<?php

use Stripe\Stripe;

require "functions.php";
require "stripe/init.php";

if (
    empty($_POST["date"]) || empty($_POST["time"]) ||
    empty($_POST["place"]) || empty($_POST["event_id"]) ||
    empty($_POST["event_name"])
) {
    $_SESSION["empty"] = 1;
    header("Location: ../index.php");
    die();
}

$pdo = connectDB();
$time = [10, 14, 18, 22];

$query = $pdo->prepare("SELECT type_event, start_date_event, end_date_event FROM gigaecureil_event WHERE id=:id");
$query->execute(["id" => $_POST["event_id"]]);
$result = $query->fetch();

if ($_POST["date"] < $result["start_date_event"] || $_POST["date"] > $result["end_date_event"]) {
    $_SESSION["badDate"] = 1;
    header("Location: ../index.php");
    die();
} elseif (!in_array($_POST["time"], $time)) {
    $_SESSION["badDate"] = 1;
    header("Location: ../index.php");
    die();
}

$events = ["marathon" => "price_1LHRCOAzApjgsM9W61oeVBAq", "avant-premiere" => "price_1LHRBIAzApjgsM9WePQxrosN", "re-visionnage" => "price_1LHRDkAzApjgsM9WXYMkpIF5"];
if (isConnected($pdo)) {
    Stripe::setApiKey("sk_test_51L53G8AzApjgsM9WZJl6ELzVSmw0nPrE0f1pBJxQPJz7HSDGqIOVsTZYAUpnSgcrIOrB1GqTAd5qoBAv6bmhOKQk00QDVr8jDR");
    header("Content-Type: application/json");
    $domain = "https://leslumieres.site";
    $checkout_session = \Stripe\Checkout\Session::create([
        "line_items" => [[
            # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
            "price" => $events[$result["type_event"]],
            "quantity" => $_POST["place"],
        ]],
        "mode" => "payment",
        "success_url" => $domain . "Scripts/successEvent.php?date=" . $_POST["date"] . "&time=" . $_POST["time"] . "&event_id=" . $_POST["event_id"] . "&event_name=" . $_POST["event_name"] . "&place=" . $_POST["place"],
        "cancel_url" => $domain . "Scripts/cancel.php",
    ]);
    $_SESSION["stripe_ok"] = 1;
    header("HTTP/1.1 303 See Other");
    header("Location: " . $checkout_session->url);
} else {
    $_SESSION["notLogged"] = 1;
    header("Location: ../index.php");
}
