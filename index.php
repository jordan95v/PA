<?php
include 'Templates/header.php';
?>

<div class="container">
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
    <div class="row py-4 row-cols-1 row-cols-lg-4 g-4 text-dark">
        <div class="col">
            <div class="card h-100 border-0 shadow-lg">
                <img src="Images/avengers.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h4 class="card-title">Avengers</h4>
                    <p class="card-text">This is the avengers movie.</p>
                </div>
            </div>
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