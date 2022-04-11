<?php
session_start()
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
    <link rel="stylesheet" href="static/style.css">
</head>

<body class="bg-dark text-light">
    <!-- Navbar + jumbotron -->
    <div class="jumbotron" id="main">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <div class="container-fluid">
                    <a class="navbar-brand text-uppercase fw-bold" href="index.php">Les Lumières</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <form class="d-flex ms-auto  mt-4 mt-lg-2 film-search" method="post">
                            <input class="form-control search pe-5" type="search" placeholder="Chercher un film ..." aria-label="Search">
                            <button class="btn ms-5" type="submit">🔍</button>
                        </form>
                        <ul class="navbar-nav ms-auto mt-2 mb-lg-0">
                            <?php
                                include 'Templates/register.php';
                                include 'Templates/login.php';
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>