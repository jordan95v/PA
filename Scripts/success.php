<?php
require "functions.php";

$pdo = connectDB();

$query = $pdo->prepare("INSERT INTO megalapin_ticket (user_id, film_id) VALUES (:id, :film);");
$query->execute(["id" => $_SESSION["id"], "film" => $_SESSION["film"]]);

$_SESSION['sell'] = 1;
header("Location: ../index.php");
