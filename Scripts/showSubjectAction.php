<?php

require_once "functions.php";

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $idSubject = $_GET['id'];
    $checkIfSubjectExist = $pdo->prepare("SELECT * FROM geantemarmotte_forum WHERE id = ?");
    $checkIfSubjectExist->execute(array($idSubject));

    if ($checkIfSubjectExist->rowCount()) {

        $SubjectInfos = $checkIfSubjectExist->fetch();

        $SubjectTitle = $SubjectInfos['title'];
        $SubjectFilm = $SubjectInfos['film_subject'];
        $SubjectContent = $SubjectInfos['content'];
        $SubjectIdAuthor = $SubjectInfos['id_author'];
        $SubjectUsernameAuthor = $SubjectInfos['username_author'];
        $SubjectDate = $SubjectInfos['date_publication'];
    } else {
        $errorMsg = "Aucune question à afficher";
    }
} else {
    $errorMsg = "Aucune question n'a été trouvé";
}
