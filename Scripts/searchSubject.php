<?php

require_once "functions.php";


if (isset($_GET['searchSubject']) and !empty($_GET['searchSubject'])) {

    $searchSubject = $_GET['searchSubject'];

    $getAllSubject = $pdo->prepare('SELECT * FROM geantemarmotte_forum WHERE title LIKE "%' . $_GET['searchSubject'] . '%" ORDER BY id DESC');
    $getAllSubject->execute();
} else {
    $getAllSubject = $pdo->prepare('SELECT * FROM geantemarmotte_forum ORDER BY id DESC LIMIT 0,5');
    $getAllSubject->execute();
}
