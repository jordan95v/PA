<?php
$pdo = connectDB();
$query = $pdo->prepare("SELECT * FROM geantemarmotte_forum WHERE report = ?");
$query->execute([1]);

?>
<div class="container">
    <?php
    if (!empty($_SESSION["safePost"]) && isset($_SESSION["safePost"])) {
        echo '<div class="alert alert-info mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le signalement à été retirée.</h5>';
        echo '</div>';
        unset($_SESSION["safePost"]);
    }
    if (!empty($_SESSION["delPost"]) && isset($_SESSION["delPost"])) {
        echo '<div class="alert alert-warning mt-4 pb-1" role="alert">';
        echo '<h5 class="fw-bold">Le post à été supprimé.</h5>';
        echo '</div>';
        unset($_SESSION["delPost"]);
    }
    ?>
    <h1 class="text-center mt-5 pt-4 text-light">Section administrateur pour les films</h1>

    <div class="table-responsive">
        <table class="table mt-2 p-4 table-dark table-borderless" id="reportTable">
            <thead class="text-center" id="headers">
                <th scope="col">ID</th>
                <th scope="col">FILM_SUBJECT</th>
                <th scope="col">TITLE</th>
                <th scope="col">CONTENT</th>
                <th scope="col">USERNAME_AUTHOR</th>
                <th scope="col">DATE_PUBLICATION</th>
                <th scope="col">SAFE</th>
                <th scope="col">DELETE</th>
            </thead>
            <tbody class="text-center" id="content">
                <?php while ($reports = $query->fetch()) : ?>

                    <tr>
                        <td scope="col"><?php echo $reports['id'] ?></td>
                        <td scope="col"><?php echo $reports['film_subject'] ?></td>
                        <td scope="col"><?php echo $reports['title'] ?></td>
                        <td scope="col"><?php echo $reports['content'] ?></td>
                        <td scope="col"><?php echo $reports['username_author'] ?></td>
                        <td scope="col"><?php echo $reports['date_publication'] ?></td>
                        <td scope="col"><a href="Scripts/safePost.php?id=<?php echo $reports['id'] ?>" class="btn btn-success">SAFE</a></td>
                        <td scope="col"><a href="Scripts/deletePost.php?id=<?php echo $reports['id'] ?>" class="btn btn-danger">DELETE</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="JS/table.js"></script>