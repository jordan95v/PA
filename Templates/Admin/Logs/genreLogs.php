<tr>
    <th scope="row" id="_id"><?php echo $genre["id"]; ?></th>
    <td id="genre"><?php echo $genre["genre"]; ?></td>
    <td id="creation-date"><?php echo $genre["create_date"]; ?></td>
    <td id="updated-date"><?php echo $genre["update_date"]; ?></td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a type="button" class="btn btn-warning w-50" data-bs-toggle="modal" data-bs-target="#genre<?php echo $genre['id']; ?>-modif">Modifier</a>
            <a type="button" class="btn btn-danger w-50" data-bs-toggle="modal" data-bs-target="#genre<?php echo $genre['id']; ?>-del">Supprimer</a>
        </div>
    </td>
</tr>