<?php
include 'Templates/header.php';
updateLogs($pdo, 'films.php');

if (isset($_GET["genre"])) {
    $genre = $_GET["genre"];
    $query = $pdo->prepare("SELECT * FROM groschien_film WHERE genre=:genre;");
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

    <div class="row py-4 text-dark">
        <?php
        if (!isset($result)) {
            $query = $pdo->prepare("SELECT * FROM groschien_film;");
            $query->execute(["featured" => 1]);
            $result = $query->fetchAll();
        }

        for ($i = 0; $i < count($result); $i++) {
            include "Templates/filmModal.php";
        }
        ?>
    </div>
</div>

<?php
include "Templates/footer.php";
?>