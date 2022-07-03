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
    <div class="row py-4" id="livesearch">
    </div>

    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold text-light">Tous les films <?php echo (isset($genre)) ? "(" . ucwords($genre) . ")" : " "; ?>🎥</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <a href="films.php" class="text-danger text-decoration-none">Enlevez les filtres <span class='arrow right'></span></a>
        </div>
    </div>

    <ul class="nav justify-content-center bg-dark p-2">
        <li class="nav-item active mx-4">
            <h4><a class="nav-link navChoice white" href="?genre=action">Action</a></h4>
        </li>
        <li class="nav-item active mx-4">
            <h4><a class="nav-link navChoice white" href="?genre=aventure">Aventure</a></h4>
        </li>
        <li class="nav-item active mx-4">
            <h4><a class="nav-link navChoice white" href="?genre=comedie">Comédie</a></h4>
        </li>
        <li class="nav-item active mx-4">
            <h4><a class="nav-link navChoice white" href="?genre=drame">Drame</a></h4>
        </li>
        <li class="nav-item active mx-4">
            <h4><a class="nav-link navChoice white" href="?genre=horreur">Horreur</a></h4>
        </li>
        <li class="nav-item active mx-4">
            <h4><a class="nav-link navChoice white" href="?genre=thriller">Thriller</a></h4>
        </li>
        <li class="nav-item active mx-4">
            <h4><a class="nav-link navChoice white" href="?genre=sci-fi">Sci-Fi</a></h4>
        </li>
    </ul>

    <div class="row py-4">
        <?php
        if (!isset($result)) {
            $query = $pdo->prepare("SELECT * FROM groschien_film;");
            $query->execute();
            $result = $query->fetchAll();
        }
        for ($i = 0; $i < count($result); $i++) {
            include "Templates/Misc/filmModal.php";
        }
        ?>
    </div>
    <div class="text-center mt-2 mb-4">
        <a href="index.php" class="btn btn-outline-danger p-2">Retour à l'accueil</a>
    </div>
</div>

<?php
include "Templates/footer.php";
?>