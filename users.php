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
    <h2 class="text-center my-4">Recherche un utilsateur</h2>
    <form action="" method="get" class="my-4">
        <input type="text" class="form-control mb-2" name="search" placeholder="Entrez le nom d'utilsateur.">
        <input type="submit" class="btn btn-outline-danger w-100" value="Rechercher">
    </form>

    <h2 class="text-center my-4"><?php echo $title; ?></h2>
    <div class="table-responsive">
        <table class="table table-hover my-5 p-4 table-dark table-borderless">
            <thead class="text-center">
                <th scope="col">ID</th>
                <th scope="col">EMAIL</th>
                <th scope="col">USERNAME</th>
                <th scope="col">DATE D'ARRIVEE</th>
                <th scope="col">ADMIN</th>
                <th scope="col">ACTION</th>
            </thead>
            <tbody class="text-center">
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    $user = $result[$i];
                    $admin = ($user["is_admin"] == 0) ? "Non" : "Oui";
                    echo '<tr><th scope="row">' . $user["id"] . '</th>';
                    echo '<td>' . $user["email"] . '</td>';
                    echo '<td>' . $user["username"] . '</td>';
                    echo '<td>' . $user["creation_date"] . '</td>';
                    echo '<td>' . $admin . '</td>';
                    echo '<td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-warning">Bannir</button>
                        <button type="button" class="btn btn-danger">Supprimer</button>
                        </div></td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
include "Templates/footer.php";
?>