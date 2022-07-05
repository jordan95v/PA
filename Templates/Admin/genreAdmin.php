<?php
updateLogs($pdo, 'genre-admin.php');
?>

<h1 class="text-center mt-5 pt-4 text-light">Section administrateur pour les genres</h1>

<!-- Film form -->
<div class="bg-dark p-5 rounded">
    <h4 class="mb-4 text-center white">Ajouter un genre</h4>
    <form method="POST" action="Scripts/addGenre.php" enctype="multipart/form-data">
        <div class="text-center">
            <input type="text" name="genre" class="form-control" placeholder="Entrez le nom du genre.">
            <div id="userHelp" class="form-text text-center">Genre 🥷</div>
            <button type="submit" class="btn btn-success mt-4 w-50">Enregistrer le genre</button>
        </div>
</div>
</form>
</div>

<!-- Genre list -->
<?php
// Recupère la liste des genres présent dans la BDD.
$query = $pdo->prepare("SELECT * FROM gelar_herisson_genre ORDER BY id DESC;");
$query->execute();
$results = $query->fetchAll();
?>
<h2 class="text-center pt-5 text-light">Liste des films</h2>
<div class="table-responsive">
    <div id="logs">
        <table class="table table-hover table-dark table-borderless" id="logTable">
            <thead class="text-center" id="headers">
                <th scope="col">ID</th>
                <th scope="col" style="cursor: pointer;">GENRE</th>
                <th scope="col" style="cursor: pointer;">DATE DE CREATION</th>
                <th scope="col" style="cursor: pointer;">DATE DE MODIFICATION</th>
                <th scope="col" style="cursor: pointer;">ACTION</th>
            </thead>
            <tbody class="text-center">
                <?php
                for ($i = 0; $i < count($genres); $i++) {
                    $genre = $results[$i];
                    include "Templates/Admin/Logs/genreLogs.php";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
// Modal pour modifier et supprimer les genres.
for ($i = 0; $i < count($genres); $i++) {
    $result = $results[$i];
    include "Templates/Admin/Logs/modifyGenre.php";
}
?>

<script src="JS/table.js"></script>