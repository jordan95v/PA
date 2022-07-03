<?php

include "Templates/header.php";  

$pdo = connectDB();
if(isset($_GET['u']) && !empty($_GET['u'])){
    $token = htmlspecialchars(base64_decode($_GET['u']));
    $check = $pdo->prepare('SELECT * FROM grandegirafe_pwd_recover WHERE token_user = ?');
    $check->execute(array($token));
    $row = $check->rowCount();
    if($row == 0){
        echo "Lien non valide";
        die();
    }
}
?>


<form method ="POST" action="Scripts/password_change_post.php">
  <div class="container">
      <div class="row">
          <div class="d-flex justify-content-evenly">
            <div class="col-lg-6 mb-3 mt-5">
                <label for="exampleFormControlInput1" class="form-label">Changement de mot de passe</label>
                <input type="hidden" name="token" class="form-control mt-3" id="exampleFormControlInput1" value="<?php echo base64_decode(htmlspecialchars($_GET['u']));?>">
                <input type="password" name="password" class="form-control mt-3" required="required" id="exampleFormControlInput1" placeholder="Mot de passe">
                <input type="password" name="password_repeat" class="form-control mt-3" required="required" id="exampleFormControlInput1" placeholder="Confirmer mot de passe">
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