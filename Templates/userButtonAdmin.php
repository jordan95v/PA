<tr>
    <th scope="row"><?php echo $user["id"]; ?></th>
    <td><?php echo $user["email"]; ?></td>
    <td><?php echo $user["username"]; ?></td>
    <td><?php echo $user["creation_date"]; ?></td>
    <td><?php echo $admin; ?></td>
    <td class="text-center">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <a href="Scripts/banUser.php?id=<?php echo $user["id"]; ?>" type="button" class="btn btn-warning">Bannir</a>
            <a href="Scripts/deleteUser.php?id=<?php echo $user["id"]; ?>" type="button" class="btn btn-danger">Supprimer</a>
        </div>
    </td>
</tr>