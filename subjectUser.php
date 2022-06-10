<?php

require "Templates/header.php";
require "Scripts/infoEditSubjectAction.php";
require "Scripts/delSubject.php";
$pdo = connectDB();
$idUser = getUserId($pdo);
$getAllUserSubject = $pdo ->prepare('SELECT id, film_subject,title, content FROM geantemarmotte_forum WHERE id_author = ?');
$getAllUserSubject->execute(array($idUser));

?>

<div class="container">
    <div class="row py-3 row-cols-sm-3 row-cols-lg-3 row-cols-md-3 row-cols-sm-3 g-3 text-dark">
    <?php
    // Affichage des sujets crée par l'utilisateur
    while($subject = $getAllUserSubject->fetch()){
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
                        <?= ucwords($subject['film_subject']);?>
                    </h5>   
                    <a href="Scripts/delSubject.php?id=<?= $subject["id"];?>" class="btn btn-danger">Supprimer la question</a>
                    <a href="editSubject.php?id=<?= $subject["id"];?>" class="btn btn-primary">Modifier la question</a>
                </div>
            </div>
        </div>
        <?php

    } ?>
    </div>
</div>

