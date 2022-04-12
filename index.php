<?php
include 'Templates/header.php';
?>

<div class="container">
    <?php
    if (!empty($_SESSION['errors']) && isset($_SESSION['errors'])) {
        echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';

        for ($i=0; $i < count($_SESSION['errors']); $i++) { 
            $element = $_SESSION['errors'][$i];
            echo '<h5 class="fw-bold">- '.$element.'</h5>';
        }
        echo '</div>';
        unset($_SESSION['errors']);
    }
    if (!empty($_SESSION['created']) && isset($_SESSION['created'])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le compte à bien été crée, vous pouvez vous connecter.';
        echo '</div>';
        unset($_SESSION['created']);
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
    <div class="row py-4 row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 g-4 text-dark">
        <div class="col">
            <a href="#" class="text-decoration-none">
                <div class="card h-100 border-0">
                    <img src="Images/avengers.jpg" class="zoom card-img-top" alt="...">
                    <div class="card-body custom-cards text-light text-start ps-0">
                        <p class="card-subtitle text-secondary mb-1">USA, 2014</p>
                        <h5 class="card-title mb-4">Avengers</h5>
                        <p class="card-text text-secondary">Action, Aventure</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="#" class="text-decoration-none">
                <div class="card h-100 border-0">
                    <img src="Images/avengers.jpg" class="zoom card-img-top" alt="...">
                    <div class="card-body custom-cards text-light text-start ps-0">
                        <p class="card-subtitle text-secondary mb-1">USA, 2014</p>
                        <h5 class="card-title mb-4">Avengers</h5>
                        <p class="card-text text-secondary">Action, Aventure</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="#" class="text-decoration-none">
                <div class="card h-100 border-0">
                    <img src="Images/avengers.jpg" class="zoom card-img-top" alt="...">
                    <div class="card-body custom-cards text-light text-start ps-0">
                        <p class="card-subtitle text-secondary mb-1">USA, 2014</p>
                        <h5 class="card-title mb-4">Avengers</h5>
                        <p class="card-text text-secondary">Action, Aventure</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="#" class="text-decoration-none">
                <div class="card h-100 border-0">
                    <img src="Images/avengers.jpg" class="zoom card-img-top" alt="...">
                    <div class="card-body custom-cards text-light text-start ps-0">
                        <p class="card-subtitle text-secondary mb-1">USA, 2014</p>
                        <h5 class="card-title mb-4">Avengers</h5>
                        <p class="card-text text-secondary">Action, Aventure</p>
                    </div>
                </div>
            </a>
        </div>
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
    <div class="row py-4 row-cols-1 row-cols-lg-4 g-4 text-dark">
        <div class="col">
            <div class="card h-100 border-0 shadow-lg">
                <img src="Images/avengers.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Avengers</h5>
                    <p class="card-text">This is the avengers movie.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'Templates/footer.php';
?>