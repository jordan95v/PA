<?php 

require 'functions.php';

//$pdo = connectDB();

//$idUser = getIdUser($pdo);

$getAllUserQuestions = $pdo ->prepare('SELECT id, title, content FROM geantemarmotte_forum WHERE id_author = ?');
$getAllUserQuestions->execute(array($_SESSION[$idUser]));
?>