<div class="modal fade" id="<?php echo str_replace(' ', '-', $result['title']); ?>-modif" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="updateFilmModal"><?php echo ucwords($result['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/updateFilm.php?id=<?php echo $result['id'] ?>">
                    <div class="mb-5">
                        <input type="text" name="title" class="form-control" value="<?php echo ucwords($result['title']); ?>">
                        <div id="userHelp" class="form-text text-center">Titre du film 🐱‍👤</div>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="genre" value="<?php echo ucwords($result['genre']); ?>">
                            <option <?php echo ($result['genre']) == 'action' ? 'selected' : ''; ?> value="action">Action</option>
                            <option <?php echo ($result['genre']) == 'aventure' ? 'selected' : ''; ?> value="aventure">Aventure</option>
                            <option <?php echo ($result['genre']) == 'drame' ? 'selected' : ''; ?> value="drame">Drame</option>
                            <option <?php echo ($result['genre']) == 'horreur' ? 'selected' : ''; ?> value="horreur">Horreur</option>
                            <option <?php echo ($result['genre']) == 'thriller' ? 'selected' : ''; ?> value="thriller">Thriller</option>
                            <option <?php echo ($result['genre']) == 'sci-fi' ? 'selected' : ''; ?> value="sci-fi">Science-fiction</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="maker" class="form-control" value="<?php echo ucwords($result['maker']); ?>">
                        <div id="userHelp" class="form-text text-center">Le nom du réal 🎞</div>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="actors" class="form-control" value="<?php echo ucwords($result['actors']); ?>">
                        <div id="userHelp" class="form-text text-center">Le nom des acteurs 🎦</div>
                    </div>
                    <div class="mb-5">
                        <textarea name="desc" class="form-control" rows="4"><?php echo ucfirst($result['info']); ?></textarea>
                        <div id="userHelp" class="form-text text-center">Limitez à 255 caractères.</div>
                    </div>
                    <div class="form-check mb-4 text-start">
                        <input class="form-check-input" type="checkbox" name="featured" id="flexCheck" <?php echo ($result['featured']) == 1 ? 'checked' : ''; ?>>
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

<div class="modal fade" id="<?php echo str_replace(' ', '-', $result['title']); ?>-del" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="delModal"><?php echo ucwords($result['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/deleteFilm.php?id=<?php echo $result['id'] ?>">
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