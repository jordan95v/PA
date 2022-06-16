<?php
include "Templates/header.php";
updateLogs($pdo, 'users.php');

if (!isConnected($pdo) and !isAdmin($pdo)) {
    $_SESSION["notAdmin"] = 1;
    header("Location: index.php");
}

if (isset($_GET["search"])) {
    $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE username=:username;");
    $query->execute(["username" => $_GET["search"]]);
} else {
    $query = $pdo->prepare("SELECT * FROM petitchat_user");
    $query->execute();
}
$result = $query->fetchAll();
$title = (count($result) > 1) ? "Tous les utilisateurs" : "Résultat de la recherche";
?>

<div class="container">
    <?php
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
    <h2 class="text-center my-4">Recherche un utilsateur</h2>
    <form action="" method="get" class="my-4">
        <input type="text" class="form-control mb-2" name="search" placeholder="Entrez le nom d'utilsateur.">
        <input type="submit" class="btn btn-outline-danger w-100" value="Rechercher">
    </form>

    <h2 class="text-center pt-4"><?php echo $title; ?></h2>
    <div class="table-responsive">
        <table class="table table-hover mt-2 p-4 table-dark table-borderless">
            <thead class="text-center">
                <th scope="col">ID</th>
                <th scope="col">EMAIL</th>
                <th scope="col">USERNAME</th>
                <th scope="col">DATE D'ARRIVEE</th>
                <th scope="col">ADMIN</th>
                <th scope="col">BANNED</th>
                <th scope="col">ACTION</th>
            </thead>
            <tbody class="text-center">
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    $user = $result[$i];
                    $admin = ($user["is_admin"] == 0) ? "Non" : "Oui";
                    $banned = ($user["banned"] == 0) ? "Non" : "Oui";
                    include "Templates/userButtonAdmin.php";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
include "Templates/footer.php";
?>