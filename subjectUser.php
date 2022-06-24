<?php

include "Templates/header.php";
require "Scripts/infoEditSubjectAction.php";
require "Scripts/delSubject.php";

$pdo = connectDB();
$idUser = getUserId($pdo);
$getAllUserSubject = $pdo->prepare('SELECT id, film_subject,title, content FROM geantemarmotte_forum WHERE id_author = ?');
$getAllUserSubject->execute(array($idUser));
$count = 0;
?>

<div class="container">
    <div class="row py-4" id="livesearch">
    </div>
    <h1 class="text-center">Mes sujets</h1>

    <div class="row py-3 row-cols-sm-3 row-cols-lg-3 row-cols-md-3 row-cols-sm-3 g-3 text-dark">
        <?php
        // Affichage des sujets crée par l'utilisateur
        while ($subject = $getAllUserSubject->fetch()) {
        ?>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <a href="showSubject.php?id=<?= $subject['id']; ?>">
                            <?= $subject['title']; ?>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= ucwords($subject['film_subject']); ?>
                        </h5>
                        <a href="Scripts/delSubject.php?id=<?= $subject["id"]; ?>" class="btn btn-danger w-100 my-2">Supprimer la question</a>
                        <a href="editSubject.php?id=<?= $subject["id"]; ?>" class="btn btn-primary w-100">Modifier la question</a>
                    </div>
                </div>
            </div>
        <?php
            $count++;
        } ?>
    </div>
    <?php
    if (!$count) {
        echo '<div class="text-center">
                <h4>Vous n\'avez pas encore créer de sujet.</h4>
                <a href="forum.php" class="btn btn-warning w-50">Revenir au forum</a>
            </div>';
    } else {
        echo '<div class="text-center">
                <a href="forum.php" class="btn btn-warning w-50">Revenir au forum</a>
            </div>';
    }
    ?>
</div>

<?php
include 'Templates/footer.php';
?>