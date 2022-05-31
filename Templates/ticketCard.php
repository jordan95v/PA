<div class="card my-4 border-0">
    <div class="row g-0">
        <div class="col-md-6">
            <img src="Images/Ticket/<?php echo basename($ticket["ticket"]); ?>" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-6">
            <div class=" card-body">
                <h5 class="card-title">Billet pour <?php echo ucwords($ticket["film_name"]); ?></h5>
                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
        </div>
    </div>
</div>