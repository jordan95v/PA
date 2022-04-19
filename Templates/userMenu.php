<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $_SESSION['email'];?></a>
    <ul class="dropdown-menu dropdown-menu-center dropdown-menu-dark w-100" aria-labelledby="navbarScrollingDropdown">
        <li><a class="dropdown-item" href="#">Mon profil</a></li>
        <li><a class="dropdown-item" href="#">...</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>    
            <a href="Scripts/logOutUser.php" class="dropdown-item">Déconnexion</a>
        </li>
    </ul>
</li>