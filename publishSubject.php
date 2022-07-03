<?php

include "Templates/header.php";
require "Scripts/addPublishSubject.php";

if (!isConnected($pdo)) {
    header("Location: index.php");
}



// Requete pour afficher les films à l'affiche dans les choix possibles
$selectFilm = $pdo->prepare("SELECT title FROM groschien_film WHERE featured=:featured ORDER BY id DESC");
$selectFilm->execute(["featured" => 1]);
?>
<div class="container mt-4">
    <?php
    if (!empty($_SESSION["postSend"]) && isset($_SESSION["postSend"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le post à bien été crée !</h5>';
        echo '</div>';
        unset($_SESSION["postSend"]);
    }
    if (isset($errorMsg)) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">' . $errorMsg . '</h5>';
        echo '</div>';
    }
    ?>
    <div class="row py-4" id="livesearch">
    </div>

    <h4 class="text-light">Poster un sujet sur le forum 🥷</h4>
    <form method="POST">
        <div class="mb-4">
            <input type="text" name="title" class="form-control" placeholder="Titre de votre sujet ...">
        </div>
        <select class="form-select mb-4" aria-label="Default select example" name="film">
            <option selected>Choissiez le film</option>
            <?php
            $result = $selectFilm->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                $film = $result[$i];
                echo '<option value="' . $film["title"] . '">' . ucwords($film["title"]) . '</option>';
            }
            ?>
        </select>
        <div class="mb-2">
            <label for="exampleInputEmail1" class="form-label">Contenu du sujet</label>
            <textarea name="content" class="form-control" placeholder="Contenu (limitez à 255 caractères)"></textarea>
        </div>
        <button type="submit" class="btn btn-dark w-100" name="validate">Publier</button>
    </form>
    <div class="text-center">
        <a href="forum.php" class="btn btn-warning w-50 mt-4">Revenir au forum</a>
    </div>
</div>

<?php
include "Templates/footer.php";
?>