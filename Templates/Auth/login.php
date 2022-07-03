<li class="nav-item">
    <a class="nav-link pt-0" href="" data-bs-toggle="modal" data-bs-target="#login">Se connecter</a>

    <div class="modal fade" id="login" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h4 class="modal-title" id="loginModal">Se connecter 🤸‍♂️</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="Scripts/logInUser.php">
                        <div class="mb-5">
                            <input type="email" name="email" class="form-control" placeholder="Entrez votre email.">
                        </div>
                        <div class="mb-5">
                            <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe.">
                            <div id="pwdHelp" class="form-text text-center">Mot de passe oublier ? <a href="forgot_password.php">Cliquez ici</a></div>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Se connecter</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</li>