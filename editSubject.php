<?php

include "Templates/header.php";
require "Scripts/infoEditSubjectAction.php";
require "Scripts/editSubjectAction.php";
?>

<div class="container">
    <div class="row py-4" id="livesearch">
    </div>
    <?php
    if (isset($errorMsg)) {
        echo '<p>' . $errorMsg . '</p>';
    }
    if (isset($subjectContent)) {
    ?>
        <form method="POST" class="container">
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label"> Titre de la question </label>
                <input type="text" name="title" class="form-control" value="<?= $subjectTitle; ?>">
            </div>
            <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label"> Contenu de la question</label>
                <textarea name="content" class="form-control"><?= $subjectContent; ?></textarea>
            </div>
            <button type="submit" class="btn btn-dark w-100" name="validate">Modifier</button>
        </form>

</div>

<?php
    }
    include "Templates/footer.php";
?>