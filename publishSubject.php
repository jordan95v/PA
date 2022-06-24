<?php

include "Templates/header.php";
require "Scripts/addPublishSubject.php";

$pdo = connectDB();

if (!isConnected($pdo)) {
    header("Location: index.php");
}

if (isset($errorMsg)) {
    echo '<p>' . $errorMsg . '</p>';
}


// Requete pour afficher les films à l'affiche dans les choix possibles
$selectFilm = $pdo->prepare("SELECT title FROM groschien_film WHERE featured=:featured ORDER BY id DESC");
$selectFilm->execute(["featured" => 1]);
?>
<div class="container mt-4">
    <div class="row py-4" id="livesearch">
    </div>
    <h4 class="">Poster un sujet sur le forum 🥷</h4>
    <form method="POST">
        <div class="mb-4">
            <input type="text" name="title" class="form-control" placeholder="Titre de votre sujet ...">
        </div>
        <select class="form-select mb-4" aria-label="Default select example" name="film">
            <option selected>Choissiez le film</option>
            <?php
            while ($optionFilm = $selectFilm->fetch()) {
            ?>
                <option value="<?= $optionFilm['title']; ?>">
                    <?= ucwords($optionFilm['title']); ?>
                </option>
            <?
            }
            ?>
        </select>
        <div class="mb-4">
            <label for="exampleInputEmail1" class="form-label">Contenu du sujet</label>
            <textarea name="content" class="form-control" placeholder="Contenu (limitez à 255 caractères"></textarea>
        </div>
        <button type="submit" class="btn btn-dark w-100" name="validate">Publier</button>
    </form>
</div>

<?php

include "Templates/footer.php";

?>