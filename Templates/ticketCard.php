<div class="card my-5 border-0">
    <div class="row g-0">
        <div class="col-md-6">
            <img src="Images/Ticket/<?php echo basename($ticket["ticket"]); ?>" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-6">
            <div class=" card-body">
                <h5 class="card-title mb-5">Billet pour <?php echo ucwords($ticket["film_name"]); ?></h5>
                <p class="card-text">Présenter le billet à l'accueil du cinéma.</p>
                <a href="" class="btn btn-dark w-100">Télécharger mon billet</a>
            </div>
        </div>
    </div>
</div>