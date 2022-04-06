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
            <a href="#" class="text-danger text-decoration-none">Voir plus <span class='arrow right'></span></a>
        </div>
    </div>

    <!-- Cards for movie -->
    <div class="row py-4 row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card mx-4 h-100">
                <img src="Images/john_wick.jpg" class="card-img-top h-100" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mx-4 h-100">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a short card.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mx-4 h-100">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mx-4 h-100">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">



    <?php
    include 'Templates/footer.php';
    ?>