<?php

require_once "functions.php";
$pdo = connectDB();


if (isset($_POST['validate'])) {

    if (!empty($_POST['title']) and !empty($_POST['content'])) {

        $subjectTitle = htmlspecialchars($_POST['title']);
        $subjectContent = nl2br(htmlspecialchars($_POST['content'])); //nl2br pour autoriser les sauts de lignes
        $subjectDate = date('d/m/Y');
        $subjectIdAuthor = getUserId($pdo);
        $subjectUsernameAuthor = $_SESSION['username'];
        $subjectFilm = $_POST['film'];

        $insertSubject = $pdo->prepare('INSERT INTO geantemarmotte_forum(title, film_subject , content, id_author, username_author, date_publication) VALUES (?, ?, ?, ?, ?, ?)');
        $insertSubject->execute(
            array(
                $subjectTitle,
                $subjectFilm,
                $subjectContent,
                $subjectIdAuthor,
                $subjectUsernameAuthor,
                $subjectDate
            )
        );
        $_SESSION["postSend"] = 1;
    } else {
        $errorMsg = "Veuillez compléter tous les champs.";
    }
}
