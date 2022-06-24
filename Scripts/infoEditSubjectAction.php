<?php

require_once "functions.php";

$pdo = connectDB();

if (isset($_GET['id']) and !empty($_GET['id'])) {

    $idSubject = $_GET["id"];
    $idUser = getUserId($pdo);

    $checkIfSubjectExists = $pdo->prepare('SELECT * FROM geantemarmotte_forum WHERE id = ?');
    $checkIfSubjectExists->execute(array($idSubject));

    if ($checkIfSubjectExists->rowCount() > 0) {

        $subjectOfAuthor = $checkIfSubjectExists->fetch();
        if ($subjectOfAuthor["id_author"] == $idUser) {

            $subjectTitle = $subjectOfAuthor["title"];
            $subjectContent = $subjectOfAuthor["content"];
            $subjectDate = $subjectOfAuthor["date_publication"];

            $subjectContent = str_replace('<br />', '', $subjectContent);
        } else {
            $errorMsg = "Vous n'êtes pas l'auteur de la question";
        }
    } else {
        $errorMsg = "Aucune question à modifier";
    }
} else {
    $errorMsg = "Aucune question n'a été trouvée";
}
