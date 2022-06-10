<?php

require_once "functions.php";
$pdo = connectDB();

if(isset($_POST['validate'])){

    if(!empty($_POST['comments'])){

        $userComments = nl2br(htmlspecialchars($_POST['comments']));
        $userDate = date('d/m/Y');

        $insertComments = $pdo->prepare('INSERT INTO geantemarmotte_comments(id_author, username_author, id_subject, content, date_publication) VALUES(?, ?, ?, ?, ?)');
        $insertComments->execute(array($_SESSION['id'], $_SESSION['username'], $idSubject, $userComments, $userDate));

    }
}