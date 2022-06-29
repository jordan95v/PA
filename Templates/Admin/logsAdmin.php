<?php
updateLogs($pdo, 'logs-admin.php');
?>
<h1 class="text-center mt-5 pt-4 text-light">Section administrateur pour les logs</h1>

<!-- Logs list -->

<div class="row pt-5">
    <div class="col-12 col-md-6">
        <!-- Logs des pages du sites -->
        <?php
        $query = $pdo->prepare("SELECT * FROM grandcanard_logs ORDER BY id DESC;S");
        $query->execute();
        $result = $query->fetchAll();
        ?>
        <h2 class="text-center text-light">Nombre de vue des pages du site</h2>
        <div class="table-responsive">
            <table class="table table-hover table-dark table-borderless">
                <thead class="text-center">
                    <th scope="col">ID</th>
                    <th scope="col">PAGE NAME</th>
                    <th scope="col">VIEW COUNT</th>
                </thead>
                <tbody class="text-center">
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
    </div>
    <div class="col-12 col-md-6">
        <!-- Logs des utilsateurs -->
        <?php
        $query = $pdo->prepare("SELECT * FROM moyenlezard_user_logs ORDER BY id DESC;");
        $query->execute();
        $result = $query->fetchAll();
        ?>
        <h2 class="text-center text-light">Actions des utilsateurs</h2>
        <div class="table-responsive">
            <div id="logs">
                <table class="table table-hover table-dark table-borderless" id="logTable">
                    <thead class="text-center" id="headers">
                        <th scope="col">ID</th>
                        <th scope="col" style="cursor: pointer;">USERNAME</th>
                        <th scope="col" style="cursor: pointer;">ACTION</th>
                        <th scope="col" style="cursor: pointer;">DATE</th>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        for ($i = 0; $i < count($result); $i++) {
                            $action = $result[$i];
                            echo '<tr><th scope="row" id="_id">' . $action["id"] . '</th>';
                            $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE id=:id;");
                            $query->execute(["id" => $action["user_id"]]);
                            $username = $query->fetch()['username'];
                            echo '<td id="username">' . $username . '</td>';
                            echo '<td id="action">' . $action["type"] . '</td>';
                            echo '<td id="date">' . $action["date"] . '</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<script src="JS/table.js"></script>