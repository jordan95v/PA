<?php

require "functions.php";

$pdo = connectDB();

if (isAdmin($pdo)) {
    $query = $pdo->prepare("UPDATE petitchat_user SET banned=:banned WHERE id=:id;");
    $query->execute(["banned" => 1, "id" => $_GET["id"]]);
    $_SESSION["banned"] = 1;
    header("Location: ../users.php");
}
