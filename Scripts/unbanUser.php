<?php

require "functions.php";

$pdo = connectDB();

if (isAdmin($pdo)) {
    $query = $pdo->prepare("UPDATE petitchat_user SET banned=:banned WHERE id=:id;");
    $query->execute(["banned" => 0, "id" => $_GET["id"]]);
    $_SESSION["unbanned"] = 1;
    header("Location: ../users.php");
} else {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
}
