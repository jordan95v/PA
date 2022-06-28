<?php
require "functions.php";

$pdo = connectDB();
if (!isAdmin($pdo)) {
    $_SESSION["notAdmin"] = 1;
    header("Location: ../index.php");
    die();
}
$id = $_GET["id"];

$query = $pdo->prepare("UPDATE petitchat_user SET is_admin=:is_admin WHERE id=:id");
$query->execute(["is_admin" => 0, "id" => $id]);

$_SESSION["unAdmin"] = 1;
header("Location: ../admin.php?type=users");
