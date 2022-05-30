<?php
include "Templates/header.php";
updateLogs($pdo, 'index.php');
?>

<div class="container">
    <?php
    if (!empty($_SESSION["errors"]) && isset($_SESSION["errors"])) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';
        for ($i = 0; $i < count($_SESSION["errors"]); $i++) {
            $element = $_SESSION["errors"][$i];
            echo '<h5 class="fw-bold">- ' . $element . '</h5>';
        }
        echo '</div>';
        unset($_SESSION["errors"]);
    }
    if (!empty($_SESSION["created"]) && isset($_SESSION["created"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le compte à bien été crée, confirmez votre mail pour vous connecter.</h5>';
        echo '</div>';
        unset($_SESSION["created"]);
    }
    if (!empty($_SESSION["updated"]) && isset($_SESSION["updated"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le compte à bien été modifiée !</h5>';
        echo '</div>';
        unset($_SESSION["updated"]);
    }
    if (!empty($_SESSION["logged"]) && isset($_SESSION["logged"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">La connexion à réussi.</h5>';
        echo '</div>';
        unset($_SESSION["logged"]);
    }
    if (!empty($_SESSION["unlogged"]) && isset($_SESSION["unlogged"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">La déconnexion à réussi.</h5>';
        echo '</div>';
        unset($_SESSION["unlogged"]);
    }
    if (!empty($_SESSION["confirm"]) && isset($_SESSION["confirm"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le mail à été vérifié, vous pouvez vous connectez.</h5>';
        echo '</div>';
        unset($_SESSION["confirm"]);
    }
    if (!empty($_SESSION["upload"]) && isset($_SESSION["upload"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le film à été correctement enregistrer.</h5>';
        echo '</div>';
        unset($_SESSION["upload"]);
    }
    if (!empty($_SESSION["send"]) && isset($_SESSION["send"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">La newsletter à été envoyée.</h5>';
        echo '</div>';
        unset($_SESSION["send"]);
    }
    if (!empty($_SESSION["notAdmin"]) && isset($_SESSION["notAdmin"])) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Vous n\'avez pas la permission d\'accéder à cette page.</h5>';
        echo '</div>';
        unset($_SESSION["notAdmin"]);
    }
    if (!empty($_SESSION["empty"]) && isset($_SESSION["empty"])) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Il faut remplir tout les champs.</h5>';
        echo '</div>';
        unset($_SESSION["empty"]);
    }
    if (!empty($_SESSION["modified"]) && isset($_SESSION["modified"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le film à bien été modifiée.</h5>';
        echo '</div>';
        unset($_SESSION["modified"]);
    }
    if (!empty($_SESSION["deletedFilm"]) && isset($_SESSION["deletedFilm"])) {
        echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le film à bien été supprimé.</h5>';
        echo '</div>';
        unset($_SESSION["deletedFilm"]);
    }
    if (!empty($_SESSION["sell"]) && isset($_SESSION["sell"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">L\'achat est un succès, vous allez reçevoir votre billet dans le section Mes Billets.</h5>';
        echo '</div>';
        unset($_SESSION["sell"]);
    }
    if (!empty($_SESSION["notSell"]) && isset($_SESSION["notSell"])) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">L\'achat est annulée.</h5>';
        echo '</div>';
        unset($_SESSION["notSell"]);
    }
    if (!empty($_SESSION["notLogged"]) && isset($_SESSION["notLogged"])) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Vous devez être connectée afin d\'acheter un billet.</h5>';
        echo '</div>';
        unset($_SESSION["notLogged"]);
    }
    ?>

    <!-- Featured Movies + Cards for movies -->
    <div class="d-flex pt-4 bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold">Les films à l'affiche 🎥</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <h6><a href="featured.php" class="text-danger text-decoration-none">Voir plus <span class='arrow right'></span></a></h6>
        </div>
    </div>

    <!-- Cards for movie -->
    <div class="row py-4 row-cols-sm-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 g-4 text-dark">
        <?php
        $query = $pdo->prepare("SELECT * FROM groschien_film WHERE featured=:featured;");
        $query->execute(["featured" => 1]);
        $result = $query->fetchAll();
        $count = (count($result) >= 5) ? 5 : count($result);

        for ($i = 0; $i < $count; $i++) {
            include "Templates/filmModal.php";
        }
        ?>
    </div>
    <div class="text-center mt-2 mb-4">
        <a href="films.php" class="btn btn-outline-danger p-2">Voir tous les films</a>
    </div>
</div>

<?php
include "Templates/footer.php";
?>