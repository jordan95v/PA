<div class="modal fade" id="<?php echo str_replace(' ', '-', $results['title']); ?>-modif" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="updateFilmModal"><?php echo ucwords($results['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/updateEvent.php?id=<?php echo $results['id'] ?>">
                    <div class="mb-5">
                        <input type="text" name="title" class="form-control" value="<?php echo ucwords($results['title']); ?>">
                        <div id="userHelp" class="form-text text-center">Titre du film 🐱‍👤</div>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="maker" class="form-control" value="<?php echo ucwords($results['maker']); ?>">
                        <div id="userHelp" class="form-text text-center">Le nom du réal 🎞</div>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="actors" class="form-control" value="<?php echo ucwords($results['actors']); ?>">
                        <div id="userHelp" class="form-text text-center">Le nom des acteurs 🎦</div>
                    </div>
                    <div class="mb-5">
                        <textarea name="content" class="form-control" rows="4"><?php echo ucfirst(str_replace('<br />', '', $results['content'])); ?></textarea>
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

<div class="modal fade" id="<?php echo str_replace(' ', '-', $results['title']); ?>-del" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="delModal"><?php echo ucwords($results['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <form method="POST" action="Scripts/deleteEvent.php?id=<?php echo $results['id'] ?>">
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