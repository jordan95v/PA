<div class="modal fade" id="film" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                        <input type="text" name="actors" class="form-control" placeholder="Entrez le nom des acteurs.">
                        <div id="userHelp" class="form-text text-center">Le nom des acteurs 🎦</div>
                    </div>
                    <div class="mb-5">
                        <textarea name="desc" class="form-control" placeholder="Entrez la description du film." rows="4"></textarea>
                        <div id="userHelp" class="form-text text-center">Limitez à 255 caractères.</div>
                    </div>
                    <div class="form-check mb-4 text-start">
                        <input class="form-check-input" type="checkbox" name="featured" id="flexCheck">
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

<div class="modal fade" id="newsletter" tabindex="-1" aria-labelledby="newsletterModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="newsletterModal">Envoyer une newsletter 💌</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="Scripts/sendNews.php">
                    <div class="mb-5">
                        <input type="text" name="title" class="form-control" placeholder="Entrez le titre de la newsletter.">
                        <div id="userHelp" class="form-text text-center">Soyez créatif ✌</div>
                    </div>
                    <div class="mb-5">
                        <textarea name="body" class="form-control" placeholder="Entrez le contenu de la newsletter." rows="4"></textarea>
                        <div id="userHelp" class="form-text text-center">Laissez libre cours à votre imagination 😎</div>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Envoyez la newsletter</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>