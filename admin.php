<?php
require_once "Scripts/functions.php";
$pdo = connectDB();

if (!isAdmin($pdo)) {
    $_SESSION["notAdmin"] = 1;
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Lumières - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Bootstrap icon CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="Static/style.css">

    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="Static/favicon.ico" type="image/x-icon"> -->
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Les Lumières - Page administrateur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav text-center ms-auto">
                    <?php include "Templates/Misc/userMenu.php"; ?>
                </ul>   
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        if (!empty($_SESSION["upload"]) && isset($_SESSION["upload"])) {
            echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le film à été correctement enregistrer.</h5>';
            echo '</div>';
            unset($_SESSION["upload"]);
        }
        if (!empty($_SESSION["send"]) && isset($_SESSION["send"])) {
            echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">La newsletter à été envoyée.</h5>';
            echo '</div>';
            unset($_SESSION["send"]);
        }
        if (!empty($_SESSION["empty"]) && isset($_SESSION["empty"])) {
            echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Il faut remplir tout les champs.</h5>';
            echo '</div>';
            unset($_SESSION["empty"]);
        }
        if (!empty($_SESSION["modified"]) && isset($_SESSION["modified"])) {
            echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le film à bien été modifiée.</h5>';
            echo '</div>';
            unset($_SESSION["modified"]);
        }
        if (!empty($_SESSION["deletedFilm"]) && isset($_SESSION["deletedFilm"])) {
            echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le film à bien été supprimé.</h5>';
            echo '</div>';
            unset($_SESSION["deletedFilm"]);
        }
        if (!empty($_SESSION["banned"]) && isset($_SESSION["banned"])) {
            echo '<div class="alert alert-info mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le compte à été banni.</h5>';
            echo '</div>';
            unset($_SESSION["banned"]);
        }
        if (!empty($_SESSION["unbanned"]) && isset($_SESSION["unbanned"])) {
            echo '<div class="alert alert-info mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le compte à été débanni.</h5>';
            echo '</div>';
            unset($_SESSION["unbanned"]);
        }
        if (!empty($_SESSION["deleted"]) && isset($_SESSION["deleted"])) {
            echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le compte à été supprimé.</h5>';
            echo '</div>';
            unset($_SESSION["deleted"]);
        }
    ?>
    </div>

    <div class="container text-light">
        <h4 class="text-center text-light my-4">🙅‍♂️ Ceci est une page réservé aux administrateurs ⛔</h4>
        <h5>Choix de la section</h5>
        <ul class="nav justify-content-center bg-dark rounded p-2">
            <li class="nav-item mx-4">
                <a class="nav-link text-light" href="?type=film">Films</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link text-light" href="?type=newsletter">Newsletter</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link text-light" href="?type=event">Events</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link text-light" href="?type=users">Users</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link text-light" href="?type=logs">Logs</a>
            </li>
    </ul>

        <?php
            if ($_GET["type"] == "film")
            {
                include "Templates/Admin/filmAdmin.php";
            }
            elseif ($_GET["type"] == "newsletter")
            {
                include "Templates/Admin/newsletterAdmin.php";
            }
            elseif ($_GET["type"] == "logs")
            {
                include "Templates/Admin/logsAdmin.php";
            }
            elseif ($_GET["type"] == "users")
            {
                include "Templates/Admin/userAdmin.php";
            }
        ?>
    </div>

<?php 
include "Templates/footer.php";
?>