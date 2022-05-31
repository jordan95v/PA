<div class="col-6 col-md-2">
    <a type="button" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '-', $result[$i]['title']); ?>" class="text-decoration-none">
        <div class="card border-0 custom-cards">
            <img src="<?php echo str_replace('../', '', $result[$i]['image_path']); ?>" class="zoom card-img-top" alt="...">
            <div class="card-body text-light text-start ps-0">
                <h5 class="card-title"><?php echo ucwords($result[$i]['title']); ?></h5>
                <p class="card-text text-secondary"><?php echo ucwords($result[$i]['genre']); ?></p>
            </div>
        </div>
    </a>
</div>

<div class="modal fade" id="<?php echo str_replace(' ', '-', $result[$i]['title']); ?>" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="loginModal"><?php echo ucwords($result[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo str_replace('../', '', $result[$i]['image_path']); ?>" alt="...">
                <p class="my-4">Réalisé par <b><?php echo ucwords($result[$i]['maker']); ?></b></p>
                <p class="my-4"><b>Acteurs:</b> <?php echo ucwords($result[$i]['actors']); ?></p>
                <p class="my-4"><b>Description:</b> <?php echo ucfirst($result[$i]['info']); ?></p>
                <!-- Add description -->
                <?php
                if (isAdmin($pdo)) {
                    include "filmAdminButton.php";
                }
                ?>
                <a type="button" class="btn btn-success w-100 my-2" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '-', $result[$i]['title']); ?>-buy">Acheter un billet</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="<?php echo str_replace(' ', '-', $result[$i]['title']); ?>-modif" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="updateFilmModal"><?php echo ucwords($result[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/updateFilm.php?id=<?php echo $result[$i]['id'] ?>">
                    <div class="mb-5">
                        <input type="text" name="title" class="form-control" value="<?php echo ucwords($result[$i]['title']); ?>">
                        <div id="userHelp" class="form-text text-center">Titre du film 🐱‍👤</div>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="genre" value="<?php echo ucwords($result[$i]['genre']); ?>">
                            <option <?php echo ($result[$i]['genre']) == 'action' ? 'selected' : ''; ?> value="action">Action</option>
                            <option <?php echo ($result[$i]['genre']) == 'aventure' ? 'selected' : ''; ?> value="aventure">Aventure</option>
                            <option <?php echo ($result[$i]['genre']) == 'drame' ? 'selected' : ''; ?> value="drame">Drame</option>
                            <option <?php echo ($result[$i]['genre']) == 'horreur' ? 'selected' : ''; ?> value="horreur">Horreur</option>
                            <option <?php echo ($result[$i]['genre']) == 'thriller' ? 'selected' : ''; ?> value="thriller">Thriller</option>
                            <option <?php echo ($result[$i]['genre']) == 'sci-fi' ? 'selected' : ''; ?> value="sci-fi">Science-fiction</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="maker" class="form-control" value="<?php echo ucwords($result[$i]['maker']); ?>">
                        <div id="userHelp" class="form-text text-center">Le nom du réal 🎞</div>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="actors" class="form-control" value="<?php echo ucwords($result[$i]['actors']); ?>">
                        <div id="userHelp" class="form-text text-center">Le nom des acteurs 🎦</div>
                    </div>
                    <div class="mb-5">
                        <textarea name="desc" class="form-control" rows="4"><?php echo ucfirst($result[$i]['info']); ?></textarea>
                        <div id="userHelp" class="form-text text-center">Limitez à 255 caractères.</div>
                    </div>
                    <div class="form-check mb-4 text-start">
                        <input class="form-check-input" type="checkbox" name="featured" id="flexCheck" <?php echo ($result[$i]['featured']) == 1 ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="flexCheck">
                            Est-ce que le film est à l'affiche ?
                        </label>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Enregistrer le film</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="<?php echo str_replace(' ', '-', $result[$i]['title']); ?>-del" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="delModal"><?php echo ucwords($result[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/deleteFilm.php?id=<?php echo $result[$i]['id'] ?>">
                    <div class="mb-5">
                        <h5>Voulez vous vraiment supprimer le film ?</h5>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Supprimer le film</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="<?php echo str_replace(' ', '-', $result[$i]['title']); ?>-buy" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="delModal"><?php echo ucwords($result[$i]['title']); ?></h4>
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
                    <input type="hidden" name="film_id" value="<?php echo $result[$i]['id']; ?>">
                    <input type="hidden" name="film_name" value="<?php echo $result[$i]['title']; ?>">
                    <input type="submit" class="btn btn-success w-100 my-2" value="Acheter un billet">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>