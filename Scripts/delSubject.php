<?php

require_once "functions.php";
$pdo = connectDB();

if (isset($_GET['id']) and !empty($_GET['id'])) {

    $delQuestion = $pdo->prepare("DELETE FROM geantemarmotte_forum WHERE id = ?");
    $delQuestion->execute(array($_GET['id']));

    header("Location: ../subjectUser.php");
}
