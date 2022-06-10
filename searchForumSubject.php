<?php

require "Templates/header.php";
require "Scripts/searchSubject.php";

?>

<div class="container">
        <form method="GET">
            <div class="form-group researchSubject mt-5 row">

            <div class="col-8">
                <input type="search" name="searchSubject" class="form-control">
            </div>
            <div class="col-4">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>

            </div>
        </form>

        <br>

        <?php
        //Affichage des 5 derniers sujets
            while($subject = $getAllSubject->fetch()){
                ?>
                <div class="card cardQuestion">
                    <div class="card-header">
                        <a href="showSubject.php?id=<?= $subject['id'];?>">
                            <?= $subject['title'];?>
                        </a>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= ucwords($subject['film_subject']);?>
                        </h5> 
                    </div>
                    <div class="card-footer">
                        <?= $subject['username_author'] . " " . $subject['date_publication'];?>
                    </div>
                </div>
                <br>
                <?php
            }
        ?>
</div>