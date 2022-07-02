<?php
$query = $pdo->prepare("SELECT * FROM petitchat_user WHERE email=:email");
$query->execute(["email" => $_SESSION["email"]]);
$user = $query->fetch();
$newsletter = ($user['newsletter'] == 1) ? 'checked' : '';
?>
<div class="dropdown text-center">
    <a class="text-decoration-none dropdown-toggle white" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        <?php echo $user["username"]; ?>
    </a>

    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li>
            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#profile">Mon profil</a>
        </li>
        <li>
            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#ticket">Mes billets</a>
        </li>
        <li>
            <a class="dropdown-item" href="forum.php">Forum</a>
        </li>
        <?php
        if (isAdmin($pdo)) {
            include "Templates/Admin/adminItem.php";
        }
        ?>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a href="Scripts/logOutUser.php" class="dropdown-item">Déconnexion</a>
        </li>
    </ul>
    </ul>
</div>


<div class="modal fade" id="profile" tabindex="-1" aria-labelledby="profileModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="profileModal"><?php echo "Profil de " . $user["username"]; ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="Scripts/updateUser.php">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="avatar">
                                <div class="text-center">
                                    <img src="Images/Avatar/<?php echo $user["head"]; ?>.png" alt="" class="head">
                                </div>
                                <img src="Images/Avatar/<?php echo $user["eyes"]; ?>.png" alt="" class="eyes">
                                <img src="Images/Avatar/<?php echo $user["mouth"]; ?>.png" alt="" class="mouth">
                            </div>
                            <div class="btn-avatar text-center">
                                <h6><span class="arrow left last-head" onclick="changePart('last-head')"></span> Changer la tête <span class="arrow right next-head" onclick="changePart('next-head')"></span></h6>
                                <h6><span class="arrow left last-eyes" onclick="changePart('last-eyes')"></span> Changer les yeux <span class="arrow right next-eyes" onclick="changePart('next-eyes')"></span></h6>
                                <h6><span class="arrow left last-mouth" onclick="changePart('last-mouth')"></span> Changer la bouche <span class="arrow right next-eyes" onclick="changePart('next-mouth')"></span></h6>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="info">
                                <div class=" mb-4">
                                    <input type="email" name="email" class="form-control" value="<?php echo $user["email"]; ?>">
                                    <div id="emailHelp" class="form-text text-center">Vous voulez changer votre email 😊 ?</div>
                                </div>
                                <div class="mb-4">
                                    <input type="text" name="username" class="form-control" value="<?php echo $user["username"]; ?>">
                                    <div id="userHelp" class="form-text text-center">Vous voulez changer votre nom d'utilisateur 😊 ?</div>
                                </div>
                                <div class="mb-4">
                                    <input type="password" name="oldPassword" class="form-control" placeholder="Entrez votre ancien mot de passe.">
                                    <div id="pwdHelp" class="form-text text-center">Mot de passe oublier ? <a href="">Cliquez ici</a></div>
                                </div>
                                <div class="mb-1">
                                    <input type="password" name="password" class="form-control" placeholder="Entrez votre nouveau mot de passe.">
                                </div>
                                <div class="mb-4">
                                    <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirmez votre mot de passe">
                                </div>
                                <div class="form-check mb-4 text-start">
                                    <input class="form-check-input" type="checkbox" name="newsletter" id="flexCheck" <?php echo $newsletter; ?>>
                                    <label class="form-check-label dark" for="flexCheck">
                                        Activer / désactiver la newsletter.
                                    </label>
                                </div>
                                <input type="hidden" name="head" value="<?php echo $user["head"]; ?>" id="headInput">
                                <input type="hidden" name="eyes" value="<?php echo $user["eyes"]; ?>" id="eyesInput">
                                <input type="hidden" name="mouth" value="<?php echo $user["mouth"]; ?>" id="mouthInput">
                                <button type="submit" class="btn btn-dark w-100">Modifier mon profil</button>
                            </div>
                        </div>
                </form>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="ticket" tabindex="-1" aria-labelledby="ticketModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4>Mes billets</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <?php
                $query = $pdo->prepare("SELECT * FROM megalapin_ticket WHERE user_id=:id ORDER BY id DESC;");
                $query->execute(["id" => $_SESSION["id"]]);
                $tickets = $query->fetchAll();
                if (!empty($tickets)) {
                    echo '<h4 class="pt-4">Liste de vos billets</h4>';
                    for ($i = 0; $i < count($tickets); $i++) {
                        $ticket = $tickets[$i];
                        include 'Templates/Misc/ticketCard.php';
                    }
                } else {
                    echo '<h4 class="p-4">Vous n\'avez pas acheté de billets pour le moment.</h1>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>