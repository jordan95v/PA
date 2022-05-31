<?php

require "functions.php";

$pdo = connectDB();

if (isAdmin($pdo)) {
    $query = $pdo->prepare("DELETE FROM petitchat_user WHERE id=:id;");
    $query->execute(["id" => $_GET["id"]]);
    $_SESSION["deleted"] = 1;
    header("Location: ../users.php");
}
