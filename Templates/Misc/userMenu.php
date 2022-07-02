<?php
$query = $pdo->prepare("SELECT * FROM petitchat_user WHERE email=:email");
$query->execute(["email" => $_SESSION["email"]]);
$user = $query->fetch();
$newsletter = ($user['newsletter'] == 1) ? 'checked' : '';
?>
<div class="dropdown text-center">
    <a class="text-decoration-none dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="profileModal"><?php echo "Profil de " . $user["username"]; ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="Scripts/updateUser.php">
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
                        <label class="form-check-label" for="flexCheck">
                            Activer / désactiver la newsletter.
                        </label>
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Modifier mon profil</button>
                </form>
                <h5 class="my-5">Psssst ... Quelque petites infos sur vous 🤩</h5>
                <p class=mt-3>Vous avez rejoins <b>Les Lumières</b> le : <b><?php echo $user["creation_date"]; ?></b></p>
                <p>Dernière MaJ du profil : <b><?php echo $user["update_date"]; ?></b></p>
                <a class="btn btn-success text-center" href="PDF/donnees.php">Mes données ici !</a>
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
                $query = $pdo->prepare("SELECT * FROM megalapin_ticket WHERE user_id=:id AND statut = 0 ORDER BY id DESC;");
                $query->execute(["id" => $_SESSION["id"]]);
                $tickets = $query->fetchAll();
                if (!empty($tickets)) {
                    echo '<h4 class="text-light pt-4">Liste de vos billets</h4>';
                    for ($i = 0; $i < count($tickets); $i++) {
                        $ticket = $tickets[$i];
                        include 'Templates/Misc/ticketCard.php';
                    }
                } else {
                    echo '<h4 class="text-light p-4">Vous n\'avez pas acheté de billets pour le moment.</h1>';
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>