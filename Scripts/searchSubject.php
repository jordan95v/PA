<?php

require_once "functions.php"; 


if(isset($_GET['searchSubject']) AND !empty($_GET['searchSubject'])){
    
    $searchSubject = isset($_GET['searchSubject']) ? $_GET['searchSubject'] : NULL;

    $getAllSubject = $pdo->prepare('SELECT * FROM geantemarmotte_forum WHERE title LIKE "%'.$_GET['searchSubject'].'%" ORDER BY id DESC');
    $getAllSubject->execute();

}else{

    $getAllSubject = $pdo->prepare('SELECT * FROM geantemarmotte_forum ORDER BY id DESC LIMIT 0,5');
    $getAllSubject->execute();

}