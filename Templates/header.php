<?php
require_once 'Scripts/functions.php';
$pdo = connectDB();

if (isset($_SESSION["email"])) {
    if (isBanned($pdo, $_SESSION["email"])) {
        unset($_SESSION["email"]);
        unset($_SESSION["token"]);
        unset($_SESSION["username"]);
        unset($_SESSION["id"]);
        $_SESSION["banned"] = 1;
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Projet de site pour l'ESGI">
    <title>Les Lumières</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Static/style.css">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="Static/favicon.ico" type="image/x-icon"> -->
</head>

<body class="text-light">
    <!-- Navbar + jumbotron -->
    <div class="jumbotron" id="main">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand text-uppercase fw-bold ms-5" href="index.php"><img id="logo" src="Images/logo.png" alt="LES LUMIERES"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <form class="d-flex  mt-4 mt-lg-2 film-search mx-auto" method="post">
                            <input class="form-control search" type="search" id="search" placeholder="Chercher un film ..." aria-label="Search">
                            <button class="btn" type="submit">🔍</button>
                        </form>
                        <ul class="navbar-nav mt-2 mb-lg-0 text-center">
                            <div class="form-check form-switch me-md-5">
                                <input class="form-check-input" type="checkbox" role="switch" id="darkSwitch">
                                <label class="form-check-label" for="darkSwitch">Toggle Light mode</label>
                            </div>

                            <?php
                            if (isConnected($pdo)) {
                                include 'Misc/userMenu.php';
                            } else {
                                include 'Auth/register.php';
                                include 'Auth/login.php';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="text-center mt-5">
                <h1>Les Lumières<br>Le cinéma qui vous va bien.</h1>
            </div>
        </div>
    </div>