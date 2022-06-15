<!-- Affichage des events -->
<div class="col-6 col-md-2">
    <a type="button" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>" class="text-decoration-none">
        <div class="card border-0 custom-cards">
            <img src="<?php echo str_replace('../', '', $resultEvent[$i]['image_event']); ?>" class="zoom card-img-top" alt="...">
            <div class="card-body text-light text-start ps-0">
                <h5 class="card-title"><?php echo ucwords($resultEvent[$i]['title']); ?></h5>
                <p class="card-text text-secondary"><?php echo ucwords($resultEvent[$i]['type_event']); ?></p>
            </div>
        </div>
    </a>
</div>

<!-- Affichage du film dans un modal -->

<div class="modal fade" id="<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>" tabindex="-1" aria-labelledby="eventModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="loginModal"><?php echo ucwords($resultEvent[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo str_replace('../', '', $resultEvent[$i]['image_event']); ?>" alt="...">
                <p class="my-4">Réalisé par <b><?php echo ucwords($resultEvent[$i]['maker']); ?></b></p>
                <p class="my-4"><b>Acteurs:</b> <?php echo ucwords($resultEvent[$i]['actors']); ?></p>
                <p class="my-4"><b>Description:</b> <?php echo ucfirst($resultEvent[$i]['content']); ?></p>
                <?php
                if (isAdmin($pdo)) {
                    include "eventAdminButton.php";
                }
                ?>
                <a type="button" class="btn btn-success w-100 my-2" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>-buy">Acheter un billet</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modification de l'event --> 

<div class="modal fade" id="<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>-modif" tabindex="-1" aria-labelledby="eventModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="updateEventModal"><?php echo ucwords($resultEvent[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/updateEvent.php?id=<?php echo $resultEvent[$i]['id'] ?>">
                    <div class="mb-5">
                        <input type="text" name="title" class="form-control" value="<?php echo ucwords($resultEvent[$i]['title']); ?>">
                        <div id="userHelp" class="form-text text-center">Titre de l'évènement 🐱‍👤</div>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="maker" class="form-control" value="<?php echo ucwords($resultEvent[$i]['maker']); ?>">
                        <div id="userHelp" class="form-text text-center">Le nom du réal 🎞</div>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="actors" class="form-control" value="<?php echo ucwords($resultEvent[$i]['actors']); ?>">
                        <div id="userHelp" class="form-text text-center">Le nom des acteurs 🎦</div>
                    </div>
                    <div class="mb-5">
                        <textarea name="content" class="form-control" rows="4"><?php echo ucfirst(str_replace('<br />', '', $resultEvent[$i]['content'])); ?></textarea>
                        <div id="userHelp" class="form-text text-center">Limitez à 255 caractères.</div>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Enregistrer l'évènement</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Suppression de l'évènement -->

<div class="modal fade" id="<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>-del" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="delModal"><?php echo ucwords($resultEvent[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/deleteEvent.php?id=<?php echo $resultEvent[$i]['id'] ?>">
                    <div class="mb-5">
                        <h5>Voulez vous vraiment supprimer l'évènement ?</h5>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Supprimer l'évènement</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Achat du billet pour l'évènement -->

<div class="modal fade" id="<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>-buy" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="delModal"><?php echo ucwords($resultEvent[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4 class="text-center mb-4">Choisissez votre séance</h4>
                <form action="Scripts/pay.php" method="post">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="col-12 col-md-6">
                            <select name="time" class="form-select">
                                <option value="" selected>Choose an hour</option>
                                <option value="10">10 : 00</option>
                                <option value="14">14 : 00</option>
                                <option value="18">18 : 00</option>
                                <option value="22">22 : 00</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="film_id" value="<?php echo $resultEvent[$i]['id']; ?>">
                    <input type="hidden" name="film_name" value="<?php echo $resultEvent[$i]['title']; ?>">
                    <input type="submit" class="btn btn-success w-100 my-2" value="Acheter un billet">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>