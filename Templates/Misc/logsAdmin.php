<h1 class="text-center mt-5 pt-4">Section administrateur pour les logs</h1>

<!-- Logs list -->

<div class="row pt-5">
    <div class="col-12 col-md-6">
        <!-- Logs des pages du sites -->
        <?php
        $query = $pdo->prepare("SELECT * FROM grandcanard_logs ORDER BY id DESC;S");
        $query->execute();
        $result = $query->fetchAll();
        ?>
        <h2 class="text-center">Logs de vue des pages du site</h2>
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
            <h2 class="text-center">Logs d'actions des utilsateurs</h2>
            <div class="table-responsive">
                <div id="logs">
                    <table class="table table-hover table-dark table-borderless">
                        <thead class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">USERNAME</th>
                            <th scope="col">ACTION</th>
                            <th scope="col">DATE</th>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            for ($i = 0; $i < count($result); $i++) {
                                $action = $result[$i];
                                echo '<tr><th scope="row">' . $action["id"] . '</th>';
                                $query = $pdo->prepare("SELECT * FROM petitchat_user WHERE id=:id;");
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
        </div>
    </div>
</div>