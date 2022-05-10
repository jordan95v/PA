<?php
include 'Templates/header.php';
?>

<div class="container">
    <?php
    if (!empty($_SESSION['errors']) && isset($_SESSION['errors'])) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';

        for ($i = 0; $i < count($_SESSION['errors']); $i++) {
            $element = $_SESSION['errors'][$i];
            echo '<h5 class="fw-bold">- ' . $element . '</h5>';
        }
        echo '</div>';
        unset($_SESSION['errors']);
    }
    if (!empty($_SESSION['created']) && isset($_SESSION['created'])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le compte à bien été crée, confirmez votre mail pour vous connecter.';
        echo '</div>';
        unset($_SESSION['created']);
    }
    if (!empty($_SESSION['updated']) && isset($_SESSION['updated'])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le compte à bien été modifiée !';
        echo '</div>';
        unset($_SESSION['updated']);
    }
    if (!empty($_SESSION['logged']) && isset($_SESSION['logged'])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">La connexion à réussi.';
        echo '</div>';
        unset($_SESSION['logged']);
    }
    if (!empty($_SESSION['unlogged']) && isset($_SESSION['unlogged'])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">La déconnexion à réussi.';
        echo '</div>';
        unset($_SESSION['unlogged']);
    }
    if (!empty($_SESSION['confirm']) && isset($_SESSION['confirm'])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le mail à été vérifié, vous pouvez vous connectez.';
        echo '</div>';
        unset($_SESSION['confirm']);
    }
    if (!empty($_SESSION['upload']) && isset($_SESSION['upload'])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le film à été correctement enregistrer.';
        echo '</div>';
        unset($_SESSION['upload']);
    }
    if (!empty($_SESSION['send']) && isset($_SESSION['send'])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">La newsletter à été envoyée.';
        echo '</div>';
        unset($_SESSION['send']);
    }
    ?>
    <!-- Featured Movies + Cards for movies -->
    <div class="d-flex pt-4 bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold">Les films à l'affiche 🎥</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <h6><a href="#" class="text-danger text-decoration-none">Voir plus <span class='arrow right'></span></a></h6>
        </div>
    </div>

    <!-- Cards for movie -->
    
    <div class="row py-4 row-cols-sm-2 row-cols-lg-5 row-cols-md-3 row-cols-sm-2 g-4 text-dark">
        <?php
            $pdo=connectDB();
            $query=$pdo->prepare('SELECT * FROM groschien_film');
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

    <div class="d-flex pt-4 bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight">
            <h2 class="fw-bold">Les nouveaux films 🎥</h2>
        </div>
        <div class="p-3 flex-shrink-1 bd-highlight">
            <a href="#" class="text-danger text-decoration-none">Voir plus <span class='arrow right'></span></a>
        </div>
    </div>

    <!-- Cards for movie -->
    <!-- <div class="row py-4 row-cols-1 row-cols-lg-4 g-4 text-dark">
        <div class="col">
            <div class="card border-0 shadow-lg">
                <img src="Images/avengers.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Avengers</h5>
                    <p class="card-text">This is the avengers movie.</p>
                </div>
            </div>
        </div>
    </div> -->
</div>

<?php
include 'Templates/footer.php';
?>