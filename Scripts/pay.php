<?php

use Stripe\Stripe;

require "functions.php";
require "stripe/init.php";

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys


Stripe::setApiKey("sk_test_51L53G8AzApjgsM9WZJl6ELzVSmw0nPrE0f1pBJxQPJz7HSDGqIOVsTZYAUpnSgcrIOrB1GqTAd5qoBAv6bmhOKQk00QDVr8jDR");
header('Content-Type: application/json');

$domain = "http://localhost";

$checkout_session = \Stripe\Checkout\Session::create([
    'line_items' => [[
        # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
        'price' => 'price_1L53zcAzApjgsM9WGe82vWKQ',
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $domain . '/PA/Scripts/success.php',
    'cancel_url' => $domain . '/PA/Scripts/cancel.html',
]);
$_SESSION["film"] = $_POST["film"];
header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);