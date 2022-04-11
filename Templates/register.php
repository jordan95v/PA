<li class="nav-item">
    <a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#register">S'inscrire</a>

    <div class="modal fade mt-5" id="register" tabindex="-1" aria-labelledby="registerModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h4 class="modal-title" id="loginModal">S'inscrire 📝</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="index.php">
                        <div class="mb-5">
                            <input type="email" name="email" class="form-control" placeholder="Entrez votre email">
                            <div id="emailHelp" class="form-text text-center">On la partegera à personne 😉</div>
                        </div>
                        <div class="mb-5">
                            <input type="text" name="username" class="form-control" placeholder="Entrez votre nom d'utilisateur.">
                            <div id="userHelp" class="form-text text-center">Faite nous rire 😉 !</div>
                        </div>
                        <div class="mb-2">
                            <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe.">
                        </div>
                        <div class="mb-5">
                            <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirmez votre mot de passe.">
                            <div id="pwdHelp" class="form-text text-center">Vous trompez pas, c'est relou de tout réecrire ! 😎</div>
                        </div>


                        <div class="form-check mb-1 text-start">
                            <input class="form-check-input" type="checkbox" name="age" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Je confirme avoir plus de 13 ans.
                            </label>
                        </div>
                        <div class="form-check mb-3 text-start">
                            <input class="form-check-input" type="checkbox" name="cgu" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Je confirme avoir lu les CGU.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">S'inscrire</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</li>