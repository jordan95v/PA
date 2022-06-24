<?php
include "Templates/header.php";

?>

<div class="container">
    <div class="row py-4" id="livesearch">
    </div>

    <div class="d-flex pt-4 bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold">Forum des Lumières ⭐</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <div class="btn-group" role="group" aria-label="Basic outlined example">
                <a href="subjectUser.php" class="btn btn-primary">Mes sujets</a>
                <a href="searchForumSubject.php" class="btn btn-primary">Rechercher</a>
                <a href="publishSubject.php" class="btn btn-primary">Poster</a>
            </div>
        </div>
    </div>

    <div class="row py-4 row-cols-sm-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 g-4 text-dark">
        <?php
        //Afficher les films à l'affiche vers leurs sujets
        $query = $pdo->prepare("SELECT * FROM groschien_film WHERE featured=:featured");
        $query->execute(["featured" => 1]);
        $result = $query->fetchAll();
        $count = (count($result) >= 5) ? 5 : count($result);

        for ($i = 0; $i < $count; $i++) {
            echo '
                <div class="col">
                    <a href="#" class="text-decoration-none">
                        <div class="card border-0">
                            <a href="subjectFilm.php?film=' . $result[$i]['title'] . '"><img src="' . str_replace('../', '', $result[$i]['image_path']) . '" class="zoom card-img-top" alt="..."></a>
                            <div class="card-body custom-cards text-light text-start ps-0">
                                <h5 class="card-title mb-4">' . ucwords($result[$i]['title']) . '</h5>
                                <p class="card-text text-secondary">' . ucwords($result[$i]['genre']) . '</p>
                            </div>
                        </div>
                    </a>
                </div>
                ';
        }
        ?>
    </div>
</div>

<?php
include 'Templates/footer.php';
?>