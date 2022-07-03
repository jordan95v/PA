<li class="nav-item">
    <a class="nav-link pt-0" href="" data-bs-toggle="modal" data-bs-target="#register">S'inscrire</a>

    <div class="modal fade" id="register" tabindex="-1" aria-labelledby="registerModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h4 class="modal-title" id="loginModal">S'inscrire 📝</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="Scripts/addUser.php">
                        <div class="mb-4">
                            <input type="email" name="email" class="form-control" placeholder="Entrez votre email" required="required">
                            <div id="emailHelp" class="form-text text-center">On la partegera à personne 😉</div>
                        </div>
                        <div class="mb-4">
                            <input type="text" name="username" class="form-control" placeholder="Entrez votre nom d'utilisateur." required="required">
                            <div id="userHelp" class="form-text text-center">Faite nous rire 😉 !</div>
                        </div>
                        <div class="mb-2">
                            <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe." required="required">
                        </div>
                        <div class="mb-4">
                            <input type="password" name="passwordConfirm" class="form-control" placeholder="Confirmez votre mot de passe." required="required">
                            <div id="pwdHelp" class="form-text text-center">Vous trompez pas, c'est relou de tout réecrire ! 😎</div>
                        </div>
                        <div id="captcha" class="mb-4">
                            <img src="Images/Captcha/pikachu.png" alt="" id="Pikachu" class="captchaBtn">
                            <img src="Images/Captcha/ronflex.png" alt="" id="Ronflex" class="captchaBtn">
                            <img src="Images/Captcha/salameche.png" alt="" id="Salameche" class="captchaBtn">
                            <img src="Images/Captcha/bulbizarre.png" alt="" id="Bulbizarre" class="captchaBtn">
                            <img src="Images/Captcha/miaouss.png" alt="" id="Miaouss" class="captchaBtn">
                            <div id="captchaHelp" class="form-text text-center"></div>
                        </div>
                        <div class="form-check mb-1 text-start">
                            <input class="form-check-input" type="checkbox" name="age" id="flexCheckDefault" required="required">
                            <label class="form-check-label dark" for="flexCheckDefault">
                                Je confirme avoir plus de 13 ans.
                            </label>
                        </div>
                        <div class="form-check mb-1 text-start">
                            <input class="form-check-input" type="checkbox" name="newsletter" id="flexCheckDefault">
                            <label class="form-check-label dark" for="flexCheckDefault">
                                Je m'inscrit à la newsletter.
                            </label>
                        </div>
                        <div class="form-check mb-4 text-start">
                            <input class="form-check-input" type="checkbox" name="cgu" id="flexCheckDefault" required="required">
                            <label class="form-check-label dark" for="flexCheckDefault">
                                Je confirme avoir lu les CGU.
                            </label>
                        </div>
                        <button id="reg" type="submit" class="btn btn-dark w-100 disabled">S'inscrire</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</li>