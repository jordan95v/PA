<div class="card p-3 mb-4 border-0">
    <div class="row g-0">
        <div class="col-md-6">
            <img src="Images/Ticket/<?php echo basename($ticketEvent["ticket"]); ?>" class="img-fluid rounded" alt="...">
        </div>
        <div class="col-md-6">
            <div class="card-body text-light">
                <h5 class="card-title mb-4">Billet pour <?php echo ucwords($ticketEvent["event_name"]); ?></h5>
                <p class="card-text">Présenter le billet à l'accueil du cinéma.</p>
                <a href="<?php echo str_replace("../", "", $ticketEvent["ticket"]); ?>" download="<?php echo basename($ticketEvent["ticket"]); ?>" class="btn btn-danger w-100">Télécharger mon billet</a>
            </div>
        </div>
    </div>
</div>