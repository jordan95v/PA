<?php
require_once "functions.php";

$pdo = connectDB();

if (!isset($_POST["ticket"]) || empty($_POST["ticket"]) || !isset($_POST["nbrplace"]) || empty($_POST["nbrplace"])) {
    die();
}

$query = $pdo->prepare('SELECT place FROM megalapin_ticket WHERE code=:code');
$query->execute(["code" => $_POST["ticket"]]);
$statut = $query->fetch();

$query = $pdo->prepare('SELECT place FROM mignonours_ticket_event WHERE code=:code');
$query->execute(["code" => $_POST["ticket"]]);
$ticket = $query->fetch();

if (!empty($statut)) {
    if ($statut["place"] - $_POST["nbrplace"] < 0) {
        $_SESSION["invalid"] = 1;
        header("Location: ../admin.php?type=ticket");
    } else {
        $query = $pdo->prepare('UPDATE megalapin_ticket SET place = place - :place  WHERE code=:code');
        $query->execute(["code" => $_POST["ticket"], "place" => $_POST["nbrplace"]]);
        $place = strval($statut["place"] - $_POST["nbrplace"]);
        $_SESSION["valid"] = "Le ticket est valide, il reste " . $place . " places sur le ticket.";
        header("Location: ../admin.php?type=ticket");
    }
}
if (!empty($ticket)) {
    if ($ticket["place"] - $_POST["nbrplace"] < 0) {
        $_SESSION["invalid"] = 1;
        header("Location: ../admin.php?type=ticket");
    } else {
        $query = $pdo->prepare('UPDATE mignonours_ticket_event SET place = place - :place  WHERE code=:code');
        $query->execute(["code" => $_POST["ticket"], "place" => $_POST["nbrplace"]]);
        $place = strval($ticket["place"] - $_POST["nbrplace"]);
        $_SESSION["valid"] = "Le ticket est valide, il reste " . $place . " places sur le ticket.";
        header("Location: ../admin.php?type=ticket");
    }
}
