<?php

require "Templates/header.php";
$pdo = connectDB();

if(isset($_GET['film']) AND !empty($_GET['film'])){

    $subjectFilm = $pdo->prepare('SELECT id, film_subject, title, content, username_author, date_publication FROM geantemarmotte_forum WHERE film_subject=:film_subject ORDER BY id DESC');
    $subjectFilm->execute(['film_subject' => $_GET['film']]);

}else{
    echo "il n'y a pas de sujet pour ce film";
}

?>


<div class="container">

    <?php
    // Affichage des sujets par rapport au film
        while($film = $subjectFilm->fetch()){
            ?>
            <br>
            <div class="card cardQuestion">
                <div class="card-header">
                    <a href="showSubject.php?id=<?= $film['id'];?>">
                        <?= $film['title'];?>
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <?= ucwords($film['film_subject']);?>
                    </h5>
                </div>
                <div class="card-footer">
                    <?= $film['username_author'] . " " . $film['date_publication'];?>
                </div>
            </div>
            <br>
            <?php
        }
        
    ?>

</div>