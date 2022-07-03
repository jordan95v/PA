<?php
require('functions.php');
$pdo = connectDB();


$id = $_GET['id'];
if (isAdmin($pdo)) {
    if (isset($id) && !empty($id)) {
        // Verrification, pour savoir si le post existe en base via l'id
        $query = $pdo->prepare('SELECT * FROM geantemarmotte_forum WHERE id=:id');
        $query->execute(['id' => $id]);
        $CommentExist = $query->fetch(); // Range le résultat dans un tableau

        // Si $CommentExist == true (n'est pas vide) alors...
        if ($CommentExist) {
            // Delete le commentaire
            $query = $pdo->prepare('DELETE FROM geantemarmotte_forum WHERE id=:id');
            $query->execute(['id' => $id]);
            $_SESSION["delPost"] = 1;
            header('Location: ../admin.php?type=report');
            die;
        } else {
            // Message et redirection, n'exsite pas
        }
    }
} else {
    $_SESSION["notAdmin"] = 1;
    header('Location: ../index.php');
    die;
}
