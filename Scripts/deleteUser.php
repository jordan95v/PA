<?php

require "functions.php";

$pdo = connectDB();

if (isAdmin($pdo)) {
    $query = $pdo->prepare("DELETE FROM petitchat_user WHERE id=:id;");
    $query->execute(["id" => $_GET["id"]]);
    updateUserLogs($pdo, $_SESSION["id"], "deleted user id: " . $_GET["id"] . ".");
    $_SESSION["deleted"] = 1;
    header("Location: ../admin.php?type=users");
} else {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
}
