<?php
require "../Scripts/functions.php";
$pdo = connectDB();

$param = htmlspecialchars($_GET["q"]);

$query = $pdo->prepare("SELECT * FROM groschien_film");
$query->execute();
$result = $query->fetchAll();
$count = 0;

for ($i = 0; $i < count($result); $i++) {
    if (strchr($result[$i]["title"], trim($param))) {
        include "../Templates/Misc/filmModal.php";
        $count++;
    }
}

if (!$count) {
    echo '<p class="text-danger">No suggestions</p>';
}
