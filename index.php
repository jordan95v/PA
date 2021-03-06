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
    if (!empty($_SESSION["banned"]) && isset($_SESSION["banned"])) {
        echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Votre compte est banni, veuillez contacter le support.</h5>';
        echo '</div>';
        unset($_SESSION["banned"]);
    }
    if (!empty($_SESSION["badDate"]) && isset($_SESSION["badDate"])) {
        echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Choisissez une date et une heure valide.</h5>';
        echo '</div>';
        unset($_SESSION["badDate"]);
    }
    if (!empty($_SESSION["badAccount"]) && isset($_SESSION["badAccount"])) {
        echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Mauvais compte.</h5>';
        echo '</div>';
        unset($_SESSION["badAccount"]);
    }
    if (!empty($_SESSION["badLink"]) && isset($_SESSION["badLink"])) {
        echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Mauvais lien.</h5>';
        echo '</div>';
        unset($_SESSION["badLink"]);
    }
    ?>

    <div class="row py-4" id="livesearch">
    </div>

    <!-- Featured Movies + Cards for movies -->
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold text-light">Les films à l'affiche 🎥</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <h6><a href="films.php" class="text-danger text-decoration-none">Voir plus <span class='arrow right'></span></a></h6>
        </div>
    </div>

    <!-- Cards for movie -->
    <div class="row py-4">
        <?php
        $query = $pdo->prepare("SELECT * FROM groschien_film WHERE featured=:featured;");
        $query->execute(["featured" => 1]);
        $result = $query->fetchAll();
        $count = (count($result) >= 5) ? 5 : count($result);

        for ($i = 0; $i < count($result); $i++) {
            include "Templates/Misc/filmModal.php";
        }
        ?>
    </div>
    <div class="text-center mt-2 mb-4">
        <a href="films.php" class="btn btn-outline-danger p-2">Voir tous les films</a>
    </div>


    <!-- Cards events -->

    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold text-light">Les évènements</h2>
        </div>
    </div>

    <div class="row py-4">
        <?php

        $queryEvent = $pdo->prepare('SELECT * FROM gigaecureil_event WHERE featured=:featured');
        $queryEvent->execute(["featured" => 1]);
        $resultEvent = $queryEvent->fetchAll();
        $count = (count($resultEvent) >= 5) ? 5 : count($resultEvent);

        for ($i = 0; $i < count($resultEvent); $i++) {
            include "Templates/Misc/eventModal.php";
        }
        ?>
    </div>

</div>
<?php
include "Templates/footer.php";
?>