<?php
include "Templates/header.php";

?>

<div class="container">
    <div class="row py-4" id="livesearch">
    </div>

    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold text-light">Forum des Lumières ⭐</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="subjectUser.php" class="btn btn-primary">Mes sujets</a>
                <a href="searchForumSubject.php" class="btn btn-primary">Rechercher</a>
                <a href="publishSubject.php" class="btn btn-primary">Poster</a>
            </div>
        </div>
    </div>

    <div class="row py-4">
        <?php
        //Afficher les films à l'affiche vers leurs sujets
        $query = $pdo->prepare("SELECT * FROM groschien_film WHERE featured=:featured");
        $query->execute(["featured" => 1]);
        $result = $query->fetchAll();
        $count = (count($result) >= 5) ? 5 : count($result);

        for ($i = 0; $i < $count; $i++) {
            include 'Templates/Misc/filmForum.php';
        }
        ?>
    </div>
</div>

<?php
include 'Templates/footer.php';
?>