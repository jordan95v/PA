<?php
require ('functions.php');
$pdo = connectDB();


$id = $_GET['id'];
if(isset($id) && !empty($id)){
    // Verrification, pour savoir si le post existe en base via l'id
    $query = $pdo->prepare('SELECT * FROM geantemarmotte_forum WHERE id=:id');
    $query->execute(['id' => $id]);
    $CommentExist = $query->fetch(); // Range le résultat dans un tableau

    // Si $CommentExist == true (n'est pas vide) alors...
    if($CommentExist){
        // Delete le commentaire
        $query = $pdo->prepare('DELETE FROM geantemarmotte_forum WHERE id=:id');
        $query->execute(['id' => $id]);
        header('Location: ../index.php');
        die;
    } else{
        // Message et redirection, n'exsite pas
    }
}else{
    header('Location: ../index.php');
    die;
}