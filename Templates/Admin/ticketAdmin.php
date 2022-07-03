<h1 class="text-center mt-5 pt-4 text-light">Vérification ticket</h1>

<div class="container">
    <?php
    if (!empty($_SESSION["valid"]) && isset($_SESSION["valid"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">' . $_SESSION["valid"] . '</h5>';
        echo '</div>';
        unset($_SESSION["valid"]);
    }
    if (!empty($_SESSION["invalid"]) && isset($_SESSION["invalid"])) {
        echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le ticket à déjà été utilisé.</h5>';
        echo '</div>';
        unset($_SESSION["invalid"]);
    }
    ?>
    <div class="bg-dark p-5 rounded">
        <form method="POST" action="Scripts/checkTicket.php">
            <div class="input-group">
                <span class="input-group-text">Vérification du ticket</span>
                <textarea class="form-control" aria-label="With textarea" name="ticket"></textarea>
            </div>
            <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#exampleModal">Vérifier</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nombre de place</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Nbr de place" name="nbrplace" aria-label="Username" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Envoyé</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>