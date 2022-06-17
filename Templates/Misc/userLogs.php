<tr>
    <th scope="row" id="_id"><?php echo $user["id"]; ?></th>
    <td id="email"><?php echo $user["email"]; ?></td>
    <td id="username"><?php echo $user["username"]; ?></td>
    <td id="creation-date"><?php echo $user["creation_date"]; ?></td>
    <td id="admin"><?php echo $admin; ?></td>
    <td id="banned"><?php echo $banned; ?></td>
    <td class="text-center">
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
            <?php
            if (isBanned($pdo, $user["email"])) {
                echo '<a href="Scripts/unbanUser.php?id=' . $user["id"] . '" type="button" class="btn btn-info">Débannir</a>';
            } else {
                echo '<a href="Scripts/banUser.php?id=' . $user["id"] . '" type="button" class="btn btn-warning">Bannir</a>';
            }
            ?>
            <a href="Scripts/deleteUser.php?id=<?php echo $user["id"]; ?>" type="button" class="btn btn-danger">Supprimer</a>
        </div>
    </td>
</tr>