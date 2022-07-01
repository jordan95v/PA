<?php
if (!empty($_SESSION["valid"]) && isset($_SESSION["valid"])) {
    echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
    echo '<h5 class="fw-bold">Le ticket est validé.</h5>';
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
<h1 class="text-center mt-5 pt-4 text-light">Vérification ticket</h1>

<div class="container">
    <div class="bg-dark p-5 rounded">
    <form method="POST" action="Scripts/checkTicket.php">
        <div class="input-group">
            <span class="input-group-text">Vérification du ticket</span>
            <textarea class="form-control" aria-label="With textarea" name="ticket"></textarea>
        </div>
        <button type="submit" class="btn btn-primary mt-5">Vérifier</button>
    </form>        
    </div>
</div>