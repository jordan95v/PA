<?php
require_once 'Scripts/functions.php';
$pdo = connectDB();
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
            <a class="navbar-brand" href="#">Les Lumières - Page administrateur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav text-center ms-auto">
                    <?php include "Templates/userMenu.php"; ?>
                </ul>   
            </div>
        </div>
    </nav>

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
                include "Templates/Misc/filmAdmin.php";
            }
            elseif ($_GET["type"] == "newsletter")
            {
                include "Templates/Misc/newsletterAdmin.php";
            }
            elseif ($_GET["type"] == "logs")
            {
                include "Templates/Misc/logsAdmin.php";
            }
            elseif ($_GET["type"] == "users")
            {
                
            }
        ?>
    </div>

<?php 
include "Templates/footer.php";
?>