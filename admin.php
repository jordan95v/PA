<?php
require_once "Scripts/functions.php";
$pdo = connectDB();

if (!isAdmin($pdo)) {
    $_SESSION["notAdmin"] = 1;
    header("Location: index.php");
}

// Récupère les genres en BDD.
$genres = getGenres($pdo);
$genreArray = [];

// Tableau avec pour clé l'id du genre et en valeur le genre.
for ($i = 0; $i < count($genres); $i++) {
    $genreArray[$genres[$i]["id"]] = $genres[$i]["genre"];
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
                    <div class="form-check form-switch me-md-5">
                        <input class="form-check-input" type="checkbox" role="switch" id="darkSwitch">
                        <label class="form-check-label white" for="darkSwitch">Toggle Light mode</label>
                    </div>
                    <?php include "Templates/Misc/userMenu.php"; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        if (!empty($_SESSION["errors"]) && isset($_SESSION["errors"])) {
            echo '<div class="alert alert-danger mt-4 pb-1" role="alert">';
            for ($i = 0; $i < count($_SESSION["errors"]); $i++) {
                $element = $_SESSION["errors"][$i];
                echo '<h5 class="fw-bold">- ' . $element . '</h5>';
            }
            echo '</div>';
            unset($_SESSION["errors"]);
        }
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
        if (!empty($_SESSION["admin"]) && isset($_SESSION["admin"])) {
            echo '<div class="alert alert-info mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le compte à été promu administrateur.</h5>';
            echo '</div>';
            unset($_SESSION["admin"]);
        }
        if (!empty($_SESSION["unAdmin"]) && isset($_SESSION["unAdmin"])) {
            echo '<div class="alert alert-info mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le rôle administrateur à été enlevé du compte.</h5>';
            echo '</div>';
            unset($_SESSION["unAdmin"]);
        }
        if (!empty($_SESSION["emptyChar"]) && isset($_SESSION["emptyChar"])) {
            echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Un des champs envoyer est vide.</h5>';
            echo '</div>';
            unset($_SESSION["emptyChar"]);
        }
        if (!empty($_SESSION["genre"]) && isset($_SESSION["genre"])) {
            echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le genre a bien été enregistrer.</h5>';
            echo '</div>';
            unset($_SESSION["genre"]);
        }
        if (!empty($_SESSION["genreExists"]) && isset($_SESSION["genreExists"])) {
            echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le genre existe déjà en BDD.</h5>';
            echo '</div>';
            unset($_SESSION["genreExists"]);
        }
        if (!empty($_SESSION["modifyGenre"]) && isset($_SESSION["modifyGenre"])) {
            echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le genre à bien été modifiée.</h5>';
            echo '</div>';
            unset($_SESSION["modifyGenre"]);
        }
        if (!empty($_SESSION["deletedGenre"]) && isset($_SESSION["deletedGenre"])) {
            echo '<div class="alert alert-success mt-4 pb-1" role="alert">';
            echo '<h5 class="fw-bold">Le genre à bien été supprimé.</h5>';
            echo '</div>';
            unset($_SESSION["deletedGenre"]);
        }
        ?>
    </div>

    <div class="container text-light">
        <h4 class="text-center text-light my-4">🙅‍♂️ Ceci est une page réservé aux administrateurs ⛔</h4>
        <h5 class="text-light">Choix de la section</h5>
        <ul class="nav justify-content-center bg-dark rounded p-2">
            <li class="nav-item mx-4">
                <a class="nav-link navChoice dropdown-toggle white" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Films</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="?type=film">Liste et création</a></li>
                    <li><a class="dropdown-item" href="?type=ticket">Ticket</a></li>
                    <li><a class="dropdown-item" href="?type=genre">Genres</a></li>
                </ul>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link white" href="?type=newsletter">Newsletter</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link white" href="?type=event">Events</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link white" href="?type=users">Users</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link white" href="?type=logs">Logs</a>
            </li>
            <li class="nav-item mx-4">
                <a class="nav-link white" href="?type=report">Report</a>
            </li>
        </ul>

        <?php
        if ($_GET["type"] == "film") {
            include "Templates/Admin/filmAdmin.php";
        } elseif ($_GET["type"] == "newsletter") {
            include "Templates/Admin/newsletterAdmin.php";
        } elseif ($_GET["type"] == "logs") {
            include "Templates/Admin/logsAdmin.php";
        } elseif ($_GET["type"] == "users") {
            include "Templates/Admin/userAdmin.php";
        } elseif ($_GET["type"] == "report") {
            include "Templates/Admin/reportAdmin.php";
        } elseif ($_GET["type"] == "ticket") {
            include "Templates/Admin/ticketAdmin.php";
        } elseif ($_GET["type"] == "event") {
            include "Templates/Admin/eventAdmin.php";
        } elseif ($_GET["type"] == "genre") {
            include "Templates/Admin/genreAdmin.php";
        }

        ?>
    </div>

    <?php
    include "Templates/footer.php";
    ?>