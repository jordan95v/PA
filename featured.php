<?php
include 'Templates/header.php';
?>

<!-- Featured Movies + Cards for movies -->
<div class="container">
    <div class="d-flex pt-4 bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold">Les films à l'affiche 🎥</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <h6><a href="index.php" class="text-danger text-decoration-none">Retour à l'accueil <span class='arrow right'></span></a></h6>
        </div>
    </div>

    <div class="row py-4 row-cols-sm-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 g-4 text-dark">
        <?php
        $query = $pdo->prepare("SELECT * FROM groschien_film WHERE featured=:featured");
        $query->execute(["featured" => 1]);
        $result = $query->fetchAll();

        for ($i = 0; $i < count($result); $i++) {
            include "Templates/filmModal.php";
        }
        ?>
    </div>
</div>

<?php
include "Templates/footer.php";
?>