<h1 class="text-center mt-5 pt-4">Section administrateur pour les films</h1>

<!-- Film form -->
<div class="bg-dark p-5 rounded">
    <h4 class="mb-4 text-center">Ajouter un film</h4>
    <form method="POST" action="Scripts/addFilm.php" enctype="multipart/form-data">
        <div class="row">
            <div class="mb-5 col-md-4 col-12">
                <input type="file" name='file' class="form-control-file">
            </div>
            <div class="mb-5 col-md-4 col-12">
                <input type="text" name="title" class="form-control" placeholder="Entrez le titre du film.">
                <div id="userHelp" class="form-text text-center">Titre du film 🐱‍👤</div>
            </div>
            <div class="mb-3 col-md-4 col-12">
                <select class="form-select" aria-label="Default select example" name="genre">
                    <option selected>Choissisez le genre du film</option>
                    <option value="action">Action</option>
                    <option value="aventure">Aventure</option>
                    <option value="drame">Drame</option>
                    <option value="horreur">Horreur</option>
                    <option value="thriller">Thriller</option>
                    <option value="sci-fi">Science-fiction</option>
                </select>
            </div>
            <div class="mb-5 col-md-6 col-12">
                <input type="text" name="maker" class="form-control" placeholder="Entrez le nom du réalisateur.">
                <div id="userHelp" class="form-text text-center">Le nom du réal 🎞</div>
            </div>
            <div class="mb-5 col-md-6 col-12">
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
            <button type="submit" class="btn btn-success w-100">Enregistrer le film</button>
        </div>
    </form>
</div>

<!-- Film list -->