<div class="modal fade" id="film" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="filmModal">Ajouter un film 🎬</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="Scripts/addFilm.php" enctype="multipart/form-data">
                    <div class="mb-5">
                        <input type="file" name='file' class="form-control-file">
                    </div>
                    <div class="mb-5">
                        <input type="text" name="title" class="form-control" placeholder="Entrez le titre du film.">
                        <div id="userHelp" class="form-text text-center">Titre du film 🐱‍👤</div>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" name="genre">
                            <option selected>Choissisez le genre du film</option>
                            <option value="action">Action</option>
                            <option value="aventure">Aventure</option>
                            <option value="drame">Drame</option>
                            <option value="horror">Horreur</option>
                            <option value="thriller">Thriller</option>
                            <option value="sci-fi">Science-fiction</option>
                        </select>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="maker" class="form-control" placeholder="Entrez le nom du réalisateur.">
                        <div id="userHelp" class="form-text text-center">Le nom du réal 🎞</div>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="actor" class="form-control" placeholder="Entrez le nom des acteurs.">
                        <div id="userHelp" class="form-text text-center">Le nom des acteurs 🎦</div>
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