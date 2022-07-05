<tr>
    <th scope="row" id="_id"><?php echo $film["id"]; ?></th>
    <td id="title"><?php echo $film["title"]; ?></td>
    <td id="genre"><?php echo $genreArray[$film['genre']]; ?></td>
    <td id="creation-date"><?php echo $film["creation_date"]; ?></td>
    <td id="updated-date"><?php echo $film["update_date"]; ?></td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a type="button" class="btn btn-warning w-50" data-bs-toggle="modal" data-bs-target="#film<?php echo $film['id']; ?>-modif">Modifier</a>
            <a type="button" class="btn btn-danger w-50" data-bs-toggle="modal" data-bs-target="#film<?php echo $film['id']; ?>-del">Supprimer</a>
        </div>
    </td>
</tr>