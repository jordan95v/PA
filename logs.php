<?php
include "Templates/header.php";
updateLogs($pdo, 'logs.php');

if (!isConnected($pdo) and !isAdmin($pdo)) {
    $_SESSION["notAdmin"] = 1;
    header("Location: index.php");
}
$query = $pdo->prepare("SELECT * FROM grandcanard_logs");
$query->execute();
$result = $query->fetchAll();
?>

<div class="container">
    <!-- Logs des pages du sites -->
    <h2 class="text-center my-4">Logs de vue des pages du site</h2>
    <div class="table-responsive">
        <table class="table table-hover my-5 p-4 table-dark">
            <thead>
                <th scope="col">ID</th>
                <th scope="col">PAGE NAME</th>
                <th scope="col">VIEW COUNT</th>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    $page = $result[$i];
                    echo '<tr><th scope="row">' . $page["id"] . '</th>';
                    echo '<td>' . $page["view"] . '</td>';
                    echo '<td>' . $page["connection"] . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    $query = $pdo->prepare("SELECT * FROM moyenlezard_user_logs");
    $query->execute();
    $result = $query->fetchAll();
    ?>
    <!-- Logs des utilsateurs -->
    <h2 class="text-center my-4">Logs d'actions des utilsateurs</h2>
    <div class="table-responsive">
        <table class="table table-hover my-5 p-4 table-dark">
            <thead>
                <th scope="col">ID</th>
                <th scope="col">USERNAME</th>
                <th scope="col">ACTION</th>
                <th scope="col">DATE</th>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    $action = $result[$i];
                    echo '<tr><th scope="row">' . $action["id"] . '</th>';
                    $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE id=:id");
                    $query->execute(["id" => $action["user_id"]]);
                    $username = $query->fetch()['username'];
                    echo '<td>' . $username . '</td>';
                    echo '<td>' . $action["type"] . '</td>';
                    echo '<td>' . $action["date"] . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
include "Templates/footer.php";
?>