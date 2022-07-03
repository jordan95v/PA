<?php

require "functions.php";

$pdo = connectDB();

if (isset($_POST["type"])) {
    if ($_SESSION["id"] == $_POST["id"]) {
        $query = $pdo->prepare("DELETE FROM petitchat_user WHERE id=:id;");
        $query->execute(["id" => $_POST["id"]]);
        updateUserLogs($pdo, $_SESSION["id"], "self deleted user id: " . $_POST["id"] . ".");
        header("Location: ../index.php");
    } else {
        $_SESSION["notAdmin"] = 1;
        header("Location: ../index.php");
        die();
    }
} elseif (isAdmin($pdo)) {
    $query = $pdo->prepare("DELETE FROM petitchat_user WHERE id=:id;");
    $query->execute(["id" => $_GET["id"]]);
    updateUserLogs($pdo, $_SESSION["id"], "deleted user id: " . $_GET["id"] . ".");
    $_SESSION["deleted"] = 1;
    header("Location: ../admin.php?type=users");
} else {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
}
