<?php
require "Templates/header.php";
$pdo = connectDB();
if (isset($_GET['film']) && !empty($_GET['film'])) {
    $subjectFilm = $pdo->prepare('SELECT id, film_subject, title, content, username_author, date_publication FROM geantemarmotte_forum WHERE film_subject=:film_subject ORDER BY id DESC');
    $subjectFilm->execute(['film_subject' => $_GET['film']]);
}
$count = 0;
?>


<div class="container">
    <div class="row py-4" id="livesearch">
    </div>
    <?php
    echo '<h1 class="text-center mb-5">Tous les sujets</h1>';
    // Affichage des sujets par rapport au film
    while ($film = $subjectFilm->fetch()) {
    ?>
        <br>
        <div class="card cardQuestion">
            <div class="card-header d-flex justify-content-between">
                <a href="showSubject.php?id=<?= $film['id']; ?>">
                    <?= $film['title']; ?>
                </a>
                <a href="Scripts/report.php?id=<?= $film['id']; ?>" class="btn btn-warning">Signaler</a>
            </div>
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <?= ucwords($film['film_subject']); ?>
                </h5>
                <p class="pb-0"><?= $film['content']; ?></p>
            </div>
            <div class="card-footer">
                <?= $film['username_author'] . " | " . $film['date_publication']; ?>
            </div>
        </div>
        <br>
    <?php
        $count++;
    }
    if (!$count) {
        echo '<div class="text-center">
            <h4 class="text-light">Pas de sujet pour ce film</h4>
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