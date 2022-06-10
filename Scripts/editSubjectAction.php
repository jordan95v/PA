<?php

require_once "functions.php";
$pdo = connectDB();

if(isset($_POST["validate"])){

    if(!empty(["title"]) AND !empty(["content"])){

        $newSubjectTitle = htmlspecialchars($_POST["title"]);
        $newSubjectContent = nl2br(htmlspecialchars($_POST["content"]));

        $editSubject = $pdo->prepare("UPDATE geantemarmotte_forum SET title = ?, content = ? WHERE id = ?");
        $editSubject->execute(array($newSubjectTitle, $newSubjectContent, $idSubject));

        header("Location: subjectUser.php");
    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}
