<?php
include 'Templates/header.php';
?>
<div class="container">
    <h1 class="text-center my-4">Payment test</h1>
    <form action="Scripts/pay.php" method="post">
        <div class="row">
            <div class="col-md-6 col-12 my-2">
                <input type="text" name="name" class="form-control" placeholder="Votre nom">
            </div>
            <div class="col-md-6 col-12 my-2">
                <input type="email" name="email" class="form-control" placeholder="Votre email">
            </div>
            <div class="col-12 my-2">
                <input type="text" name="code" class="form-control" placeholder="0000 0000 0000 0000">
            </div>
            <div class="col-md-6 col-12 my-2">
                <input type="text" name="name" class="form-control" placeholder="Code à trois chiffres">
            </div>
            <div class="col-md-6 col-12 my-2">
                <input type="text" name="name" class="form-control" placeholder="Expiration">
            </div>
            <div class="col-12">
                <input type="submit" class="btn btn-danger w-100 my-2" value="Pay">
            </div>
        </div>
    </form>
</div>

<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<?php
include "Templates/footer.php";
?>