<?php
echo '
<div class="col">
    <a type="button" data-bs-toggle="modal" data-bs-target="#' . $result[$i]['title'] . '" class="text-decoration-none">
        <div class="card border-0">
            <img src="' . str_replace('../', '', $result[$i]['image_path']) . '" class="zoom card-img-top" alt="...">
            <div class="card-body custom-cards text-light text-start ps-0">
                <h5 class="card-title">' . ucwords($result[$i]['title']) . '</h5>
                <p class="card-text text-secondary">' . ucwords($result[$i]['genre']) . '</p>
            </div>
        </div>
    </a>
</div>
';
echo '
<div class="modal fade mt-5" id="' . $result[$i]['title'] . '" tabindex="-1" aria-labelledby="filmModal" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content text-dark">
        <div class="modal-header">
            <h4 class="modal-title" id="loginModal">' . ucwords($result[$i]['title']) . '</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <img src="' . str_replace('../', '', $result[$i]['image_path']) . '" alt="...">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal">Fermer</button>
        </div>
    </div>
</div>
</div>
';
