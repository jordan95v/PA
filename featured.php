<?php
include 'Templates/header.php';
?>

<!-- Featured Movies + Cards for movies -->
<div class="container">
    <div class="d-flex pt-4 bd-highlight">
        <div class="p-2 flex-grow-1 text-center bd-highlight">
            <h2 class="fw-bold">Les films à l'affiche 🎥</h2>
        </div>
    </div>

    <div class="row py-4 row-cols-sm-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 g-4 text-dark">
        <?php
            $pdo=connectDB();
            $query=$pdo->prepare("SELECT * FROM groschien_film");
            $query->execute();
            $result = $query->fetchAll();

            for ($i=0; $i < count($result); $i++) { 
                echo '
                <div class="col">
                    <a href="#" class="text-decoration-none">
                        <div class="card border-0">
                            <img src="'.str_replace('../', '', $result[$i]['image_path']).'" class="zoom card-img-top" alt="...">
                            <div class="card-body custom-cards text-light text-start ps-0">
                                <p class="card-subtitle text-secondary mb-1">USA, 2014</p>
                                <h5 class="card-title mb-4">'.ucwords($result[$i]['title']).'</h5>
                                <p class="card-text text-secondary">'.ucwords($result[$i]['genre']).'</p>
                            </div>
                        </div>
                    </a>
                </div>
                ';
            }
        ?>
    </div>
</div>

<?php
include 'Templates/footer.php';
?>