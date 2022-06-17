<?php
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
    <h2 class="text-center pt-5 mt-4">Recherche un utilsateur</h2>
    <form action="" method="get" class="my-4">
        <input type="text" class="form-control mb-2" name="search" placeholder="Entrez le nom d'utilsateur.">
        <input type="hidden" name="type" value="users">
        <input type="submit" class="btn btn-outline-danger w-100" value="Rechercher">
    </form>

    <h2 class="text-center pt-4"><?php echo $title; ?></h2>
    <div class="table-responsive">
        <table class="table table-hover mt-2 p-4 table-dark table-borderless" id="logTable">
            <thead class="text-center" id="headers">
                <th scope="col">ID</th>
                <th scope="col"style="cursor: pointer;">EMAIL</th>
                <th scope="col" style="cursor: pointer;">USERNAME</th>
                <th scope="col" style="cursor: pointer;">DATE D'ARRIVEE</th>
                <th scope="col" style="cursor: pointer;">ADMIN</th>
                <th scope="col" style="cursor: pointer;">BANNED</th>
                <th scope="col">ACTION</th>
            </thead>
            <tbody class="text-center" id="content">
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    $user = $result[$i];
                    $admin = ($user["is_admin"] == 0) ? "Non" : "Oui";
                    $banned = ($user["banned"] == 0) ? "Non" : "Oui";
                    include "userButtonAdmin.php";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="JS/table.js"></script>