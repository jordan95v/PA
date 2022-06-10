<?php

require "Templates/header.php";
require "Scripts/showSubjectAction.php";
require "Scripts/publishComments.php";
require "Scripts/showAllComments.php";

?>

<div class="container mb-3 mt-5">
    <?php

        if(isset($errorMsg)){ echo $errorMsg; }

        if(isset($SubjectDate)){
            //Affichage du sujet recherché 
            ?>
            <div class="container cardQuestion">
                <div class="card border-dark mb-3">
                    <div class="card-header"><?= ucwords($SubjectFilm);?></div>
                    <div class="card-body text-dark">
                        <h5 class="card-title"><?= $SubjectTitle;?></h5>
                        <br>
                        <p class="card-text"><?= $SubjectContent;?></p>
                    </div>
                    <div class="card-footer bg-transparent border-success"><?= $SubjectUsernameAuthor . " " . $SubjectDate;?></div>
                </div>
                <br>
                <section class="show-answers">

                    <form class="form-group" method="POST">
                        <div class="form-floating">
                            <textarea class="form-control" id="floatingTextarea" name="comments"></textarea>
                            <label class ="cardQuestion" for="floatingTextarea">Commentaire</label>
                            <br>
                            <button class="btn btn-primary" name="validate">Publier</button>
                        </div>
                        <br>    
                    </form>


                    <?php
                        // Affichage des commentaires
                        while($comments = $allComments->fetch()){
                            ?>
                                <div class="container">
                                    <div class="card cardQuestion">
                                        <div class="card-header">
                                            <?= $comments['username_author'] . " " . $comments['date_publication'];?>
                                        </div>
                                        <div class="card-body">
                                            <?= $comments['content'];?>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            <?php
                        }                

                    ?>

                </section>
            </div>
            <?php
        }
    ?>
</div>