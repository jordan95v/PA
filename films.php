<?php
include 'Templates/header.php';

if (isset($_GET["genre"])) {
    $genre = $_GET["genre"];
    $query = $pdo->prepare("SELECT image_path, title, genre FROM groschien_film WHERE genre=:genre");
    $query->execute(["genre" => $genre]);
    $result = $query->fetchAll();
}
?>

<!-- Featured Movies + Cards for movies -->
<div class="container">
    <div class="d-flex pt-4 bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold">Tous les films <?php echo (isset($genre)) ? "(" . ucwords($genre) . ")" : " "; ?>🎥</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <a href="films.php" class="text-danger text-decoration-none">Enlevez les filtres <span class='arrow right'></span></a>
        </div>
    </div>

    <nav class="navbar navbar-expand-sm navbar-light bg-light rounded">
        <div class="mx-auto d-sm-flex d-block flex-sm-nowrap">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarsExample11">
                <ul class="navbar-nav">
                    <li class="nav-item active mx-4">
                        <h4><a class="nav-link" href="?genre=action">Action</a></h5>
                    </li>
                    <li class="nav-item active mx-4">
                        <h4><a class="nav-link" href="?genre=aventure">Aventure</a></h5>
                    </li>
                    <li class="nav-item active mx-4">
                        <h4><a class="nav-link" href="?genre=drame">Drame</a></h5>
                    </li>
                    <li class="nav-item active mx-4">
                        <h4><a class="nav-link" href="?genre=horror">Horreur</a></h5>
                    </li>
                    <li class="nav-item active mx-4">
                        <h4><a class="nav-link" href="?genre=thriller">Thriller</a></h5>
                    </li>
                    <li class="nav-item active mx-4">
                        <h4><a class="nav-link" href="?genre=sci-fi">Sci-Fi</a></h5>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row py-4 row-cols-sm-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 g-4 text-dark">
        <?php

        if (!isset($result)) {
            $query = $pdo->prepare("SELECT image_path, title, genre FROM groschien_film");
            $query->execute();
            $result = $query->fetchAll();
        }

        for ($i = 0; $i < count($result); $i++) {
            echo '
                <div class="col">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#' . $result[$i]['title'] . '" class="text-decoration-none">
                        <div class="card border-0">
                            <img src="' . str_replace('../', '', $result[$i]['image_path']) . '" class="zoom card-img-top" alt="...">
                            <div class="card-body custom-cards text-light text-start ps-0">
                                <h5 class="card-title">' . ucwords($result[$i]['title']) . '</h5>
                                <p class="card-text text-secondary">' . ucwords($result[$i]['genre']) . '</p>
                            </div>
                        </div>
                    </a>
                </div>
                ';
            echo '
            <div class="modal fade mt-5" id="' . $result[$i]['title'] . '" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content text-dark">
                        <div class="modal-header">
                            <h4 class="modal-title" id="loginModal">' . ucwords($result[$i]['title']) . '</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="' . str_replace('../', '', $result[$i]['image_path']) . '" alt="...">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
        ?>
    </div>
</div>

<?php
include "Templates/footer.php";
?>