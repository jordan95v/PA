<div class="col-6 col-md-2">
    <a type="button" href="subjectFilm.php?film=<?php echo $result[$i]["title"]; ?>" class="text-decoration-none">
        <div class="card border-0 custom-cards film">
            <img src="<?php echo str_replace('../', '', $result[$i]['image_path']); ?>" class="zoom card-img-top" alt="...">
            <div class="card-body text-start ps-0">
                <h5 class="card-title text-light"><?php echo ucwords($result[$i]['title']); ?></h5>
                <p class="card-text text-secondary"><?php echo ucwords($genreArray[$result[$i]['genre']]); ?></p>
            </div>
        </div>
    </a>
</div>