<?php
include "Templates/header.php";
require "Scripts/searchSubject.php";
?>

<div class="container">
    <div class="row py-4" id="livesearch">
    </div>

    <h2 class="text-center text-light">Rechercher un sujet 🔍</h2>
    <form method="get">
        <div class="mt-5 row">
            <div class="col-8">
                <input type="search" name="searchSubject" class="form-control" placeholder="Rechercher un sujet du forum">
            </div>
            <div class="col-4">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </div>
    </form>

    <br>
    <?php
    //Affichage des 5 derniers sujets
    while ($subject = $getAllSubject->fetch()) {
    ?>
        <div class="card cardQuestion">
            <div class="card-header">
                <a href="showSubject.php?id=<?= $subject['id']; ?>">
                    <?= $subject['title']; ?>
                </a>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <?= ucwords($subject['film_subject']); ?>
                </h5>
            </div>
            <div class="card-footer">
                <?= $subject['username_author'] . " " . $subject['date_publication']; ?>
            </div>
        </div>
        <br>
    <?php
    }
    ?>
    <div class="text-center">
        <a href="forum.php" class="btn btn-warning w-50 mt-4">Revenir au forum</a>
    </div>
</div>

<?php
include "Templates/footer.php";
?>