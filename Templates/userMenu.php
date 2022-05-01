<?php
$pdo = connectDB();
$query = $pdo->prepare('SELECT * FROM petitchat_user WHERE email=:email');
$query->execute(['email' => $_SESSION['email']]);
$user = $query->fetch();
?>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['email']; ?></a>
    <ul class="dropdown-menu dropdown-menu-center dropdown-menu-dark w-100" aria-labelledby="navbarScrollingDropdown">
        <li>
            <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#profile">Mon profil</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a href="Scripts/logOutUser.php" class="dropdown-item">Déconnexion</a>
        </li>
    </ul>
</li>

<div class="modal fade mt-5" id="profile" tabindex="-1" aria-labelledby="profileModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h4 class="modal-title" id="profileModal"><?php echo 'Profil de ' . $user['username']; ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="Scripts/updateUser.php">
                    <div class=" mb-5">
                        <input type="email" name="email" class="form-control" value="<?php echo $user['email']; ?>">
                        <div id="emailHelp" class="form-text text-center">Vous voulez changer votre email 😊 ?</div>
                    </div>
                    <div class="mb-5">
                        <input type="text" name="username" class="form-control" value="<?php echo $user['username']; ?>">
                        <div id="userHelp" class="form-text text-center">Vous voulez changer votre nom d'utilisateur 😊 ?</div>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="oldPassword" class="form-control" placeholder="Entrez votre ancien mot de passe.">
                        <div id="pwdHelp" class="form-text text-center">Mot de passe oublier ? <a href="">Cliquez ici</a></div>
                    </div>
                    <div class="mb-1">
                        <input type="password" name="password" class="form-control" placeholder="Entrez votre nouveau mot de passe.">
                    </div>
                    <div class="mb-5">
                        <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirmez votre mot de passe">
                    </div>
                    <button type="submit" class="btn btn-dark w-100">Modifier mon profil</button>
                </form>
                <h5 class="my-5">Psssst ... Quelque petites infos sur vous 🤩</h5>
                <p class=mt-3>Vous avez rejoins <b>Les Lumières</b> le : <b><?php echo $user['creation_date']; ?></b></p>
                <p>Dernière MaJ du profil : <b><?php echo $user['update_date']; ?></b></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>