<tr>
    <th scope="row" id="_id"><?php echo $event["id"]; ?></th>
    <td id="title"><?php echo $event["title"]; ?></td>
    <td id="type"><?php echo $event["type_event"]; ?></td>
    <td id="start-date"><?php echo $event["start_date_event"]; ?></td>
    <td id="end-date"><?php echo $event["end_date_event"]; ?></td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a type="button" class="btn btn-warning w-50" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '-', $event['title']); ?>-modif">Modifier</a>
            <a type="button" class="btn btn-danger w-50" data-bs-toggle="modal" data-bs-target="#<?php echo str_replace(' ', '-', $event['title']); ?>-del">Supprimer</a>
        </div>
    </td>
</tr>