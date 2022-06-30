<?php
updateLogs($pdo, 'newsletter-admin.php');
?>
<h1 class="text-center mt-5 pt-4 text-light">Section administrateur pour la newletter</h1>

<!-- Newsletter form -->
<div class="bg-dark p-5 rounded">
    <h4 class="mb-4 text-center text-light">Envoyez une newsletter</h4>
    <form method="POST" action="Scripts/sendNews.php">
        <div class="mb-5">
            <input type="text" name="title" class="form-control" placeholder="Entrez le titre de la newsletter.">
            <div id="userHelp" class="form-text text-center">Soyez créatif ✌</div>
        </div>
        <div class="mb-5">
            <textarea name="body" class="form-control" placeholder="Entrez le contenu de la newsletter." rows="4"></textarea>
            <div id="userHelp" class="form-text text-center">Laissez libre cours à votre imagination 😎</div>
        </div>
        <button type="submit" class="btn btn-success w-100">Envoyez la newsletter</button>
    </form>
</div>

<!-- Newsletter list -->
<?php
$query = $pdo->prepare("SELECT * FROM minisculecome_newsletter ORDER BY id DESC;");
$query->execute();
$result = $query->fetchAll();
?>
<!-- Logs de la newsletter -->
<h2 class="text-center pt-5 mt-4 text-light">Logs de la newsletter</h2>
<div class="table-responsive">
    <div id="logs">
        <table class="table table-hover mt-2 p-4 table-dark table-borderless" id="logTable">
            <thead class="text-center" id="headers">
                <th scope="col">ID</th>
                <th scope="col" style="cursor: pointer;">USERNAME</th>
                <th scope="col" style="cursor: pointer;">SUBJECT</th>
                <th scope="col" style="cursor: pointer;">CONTENT</th>
                <th scope="col" style="cursor: pointer;">SEND-DATE</th>
            </thead>
            <tbody class="text-center">
                <?php
                for ($i = 0; $i < count($result); $i++) {
                    $news = $result[$i];
                    include "Templates/Admin/Logs/newsletterLogs.php";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="JS/table.js"></script>