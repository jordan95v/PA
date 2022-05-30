<?php

include "Templates/header.php";

?>

<form method ="POST" action="Scripts/forgot.php">
  <div class="container">
      <div class="row">
          <div class="d-flex justify-content-evenly">
            <div class="col-lg-6 mb-3 mt-5">
                <label for="exampleFormControlInput1" class="form-label">Adresse mail</label>
                <input type="email" name="email" class="form-control" required="required" id="exampleFormControlInput1" placeholder="monnom@exemple.com">
                <div class="d-flex justify-content-center">
                  <button class="btn btn-dark mt-3" type="submit">Envoyer</button>
                </div> 
            </div>
          </div>
      </div>
  </div>
</form>

<?php

include "Templates/footer.php";

?>
