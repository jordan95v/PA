<?php

require "Templates/header.php";
require "Scripts/addPublishSubject.php";

$pdo = connectDB();

if(!isConnected($pdo)){

    header("Location: index.php");

}

if(isset($errorMsg)){ echo '<p>'.$errorMsg.'</p>';}


// Requete pour afficher les films à l'affiche dans les choix possibles
$selectFilm=$pdo->prepare("SELECT title FROM groschien_film WHERE featured=:featured ORDER BY id DESC");
$selectFilm->execute(["featured"=>1]);




?>

<form method="POST" class="container">
    <div class="mb-4">
        <label for="exampleInputEmail1" class="form-label"> Titre du sujet </label>
        <input type="text" name="title" class="form-control" placeholder="Titre de votre question ...">
    </div>
    <select class="form-select mb-4" aria-label="Default select example" name="film">
        <option selected>Choissisez film</option>
        <?php
            while($optionFilm = $selectFilm->fetch()){
                ?>
                    <option value="<?= $optionFilm['title'];?>">
                        <?= ucwords($optionFilm['title']);?>
                    </option>
                <?
            }
        ?>
    </select>
    <div class="mb-4">
        <label for="exampleInputEmail1" class="form-label"> Contenu du sujet</label>
        <textarea name="content" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-dark w-100" name="validate">Publier</button>
</form>

<?php

include "Templates/footer.php";

?>