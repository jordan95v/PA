
<h1 class="text-center mt-5 pt-4 text-light">Section administrateur pour les évènements</h1>

<!-- Film form -->
<div class="bg-dark p-5 rounded">
    <h4 class="mb-4 text-center white">Ajouter un évènement</h4>
    <form method="POST" action="Scripts/addEvent.php" enctype="multipart/form-data">
        <div class="row">
            <div class="mb-5 col-md-4 col-12">
                <input type="file" name='file' class="form-control-file white">
            </div>
            <div class="mb-5 col-md-4 col-12">
                <input type="text" name="title" class="form-control" placeholder="Entrez le titre du film.">
                <div id="userHelp" class="form-text text-center">Titre de l'évènement</div>
            </div>
            <div class="mb-3 col-md-4 col-12">
                <select class="form-select" aria-label="Default select example" name="type">
                    <option selected>Choissisez le type d'évènement</option>
                    <option value="avant-premiere">Avant-première</option>
                    <option value="re-visionnage">Re-visionnage</option>
                    <option value="marathon">Marathon</option>
                </select>
            </div>
            <div class="mb-5 col-md-6 col-12">
                <input type="text" name="maker" class="form-control" placeholder="Entrez le nom du réalisateur">
            </div>
            <div class="mb-5 col-md-6 col-12">
                <input type="text" name="actor" class="form-control" placeholder="Entrez le nom des acteurs">
            </div>
            <div class="mb-5 col-md-6 col-12">
                <input type="date" class="form-control" name="date-debut" placeholder="Date début évent">
                    Au 
                <input type="date" class="form-control" name="date-fin" placeholder="Date fin évent">
            </div>
            <div class="mb-5">
                <textarea name="content" class="form-control" placeholder="Entrez la description du film." rows="4"></textarea>
                <div id="userHelp" class="form-text text-center">Limitez à 255 caractères.</div>
            </div>
            <button type="submit" class="btn btn-success w-100">Enregistrer l'évènement</button>
        </div>
    </form>
</div>

<!-- Event list -->
<?php

$query = $pdo->prepare("SELECT * FROM gigaecureil_event ORDER BY id DESC");
$query->execute();
$result = $query->fetchAll();
?>
<h2 class="text-center pt-5 text-light">Liste des évènements</h2>
<div class="table-responsive">
    <div id="logs">
        <table class="table table-hover table-dark table-borderless" id="logTable">
            <thead class="text-center" id="headers">
                <th scope="col">ID</th>
                <th scope="col" style="cursor: pointer;">TITLE</th>
                <th scope="col" style="cursor: pointer;">TYPE_EVENT</th>
                <th scope="col" style="cursor: pointer;">START_DATE</th>
                <th scope="col" style="cursor: pointer;">END-DATE</th>
                <th scope="col" style="cursor: pointer;">ACTION</th>
            </thead>
            <tbody class="text-center">
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    $event = $result[$i];
                    include "Templates/Admin/Logs/eventLogs.php";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
for ($i = 0; $i < count($result); $i++) {
    $results = $result[$i];
    include "Templates/Admin/Logs/modifyEvent.php";
}
?>