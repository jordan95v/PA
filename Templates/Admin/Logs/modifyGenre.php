<div class="modal fade" id="genre<?php echo $result['id']; ?>-modif" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="updateFilmModal"><?php echo ucwords($result['genre']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/updateGenre.php?id=<?php echo $result['id'] ?>">
                    <input type="text" name="genre" class="form-control" value="<?php echo $result["genre"]; ?>">
                    <div id="userHelp" class="form-text text-center">Genre 🥷</div>
                    <button type="submit" class="btn btn-dark w-100">Modifier le genre</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="genre<?php echo $result['id']; ?>-del" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="delModal"><?php echo ucwords($result['genre']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/deleteGenre.php?id=<?php echo $result['id'] ?>">
                    <div class="mb-5">
                        <h5>Voulez vous vraiment supprimer le film ?</h5>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Supprimer le genre</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>