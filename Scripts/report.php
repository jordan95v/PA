<?php
require ('functions.php');
$pdo = connectDB();


//Verrification, pour savoir si le post existe en base
$id = $_GET['id'];
if(isset($id) && !empty($id)){
    $query = $pdo->prepare('SELECT * FROM geantemarmotte_forum WHERE id=:id');
    $query->execute(['id' => $id]);
    $CommentExist = $query->fetch();

    if($CommentExist){
        $query = $pdo->prepare('UPDATE geantemarmotte_forum SET report = :report WHERE id=:id;');
        $query->execute(['report' => 1,'id' => $id]);
        $_SESSION["report"] = 1;
        header('Location: ../forum.php');
        die;
    } else{
        // Message et redirection, n'exsite pas
    }
}else{
    header('Location: ../index.php');
    die;
}



?>