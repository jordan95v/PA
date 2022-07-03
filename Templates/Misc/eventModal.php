<div class="col-6 col-md-2">
    <a type="button" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>" class="text-decoration-none">
        <div class="card border-0 custom-cards film">
            <img src="<?php echo str_replace('../', '', $resultEvent[$i]['image_event']); ?>" class="zoom card-img-top" alt="...">
            <div class="card-body text-start ps-0">
                <h5 class="card-title text-light"><?php echo ucwords($resultEvent[$i]['title']); ?></h5>
                <p class="card-text text-secondary"><?php echo ucwords($resultEvent[$i]['type_event']); ?></p>
            </div>
        </div>
    </a>
</div>

<div class="modal fade" id="<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="loginModal"><?php echo ucwords($resultEvent[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="<?php echo str_replace('../', '', $resultEvent[$i]['image_event']); ?>" alt="...">
                <p class="my-4 dark"><b><?= ucwords($resultEvent[$i]['type_event']);?></b> du <?= $resultEvent[$i]['start_date_event'];?> au <?= $resultEvent[$i]['end_date_event'];?></p>
                <p class="my-4 dark">Réalisé par <b><?php echo ucwords($resultEvent[$i]['maker']); ?></b></p>
                <p class="my-4 dark"><b>Acteurs:</b> <?php echo ucwords($resultEvent[$i]['actors']); ?></p>
                <p class="my-4 dark"><b>Description:</b> <?php echo ucfirst($resultEvent[$i]['content']); ?></p>
                <a type="button" class="btn btn-success w-100 my-2" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>-buy">Acheter un billet</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="<?php echo str_replace(' ', '-', $resultEvent[$i]['title']); ?>-buy" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="delModal"><?php echo ucwords($resultEvent[$i]['title']); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h4 class="text-center mb-4">Choisissez votre séance</h4>
                <form action="Scripts/payEvent.php" method="post">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <input type="date" class="form-control" name="date">
                        </div>
                        <div class="col-12 col-md-4">
                            <select name="time" class="form-select">
                                <option value="" selected>Choose an hour</option>
                                <option value="10">10 : 00</option>
                                <option value="14">14 : 00</option>
                                <option value="18">18 : 00</option>
                                <option value="22">22 : 00</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <select name="place" class="form-select">
                                <option value="" selected>Nombre de place</option>
                                <?php
                                for ($j = 0; $j < 100; $j++) {
                                    echo '<option value="' . $j . '">' . $j . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="event_id" value="<?php echo $resultEvent[$i]["id"]; ?>">
                    <input type="hidden" name="event_name" value="<?php echo $resultEvent[$i]["title"]; ?>">
                    <input type="submit" class="btn btn-success w-100 my-2" value="Acheter un billet">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>