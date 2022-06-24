<?php
require_once "functions.php";
$pdo = connectDB();
$allComments = $pdo->prepare('SELECT id_author, username_author, id_subject, content, date_publication FROM geantemarmotte_comments WHERE id_subject = ? ORDER BY id DESC');
$allComments->execute(array($idSubject));
