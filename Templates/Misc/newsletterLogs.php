<tr>
    <?php
    $query = $pdo->prepare("SELECT username FROM petitchat_user WHERE id=:id");
    $query->execute(["id" => $news["user_id"]]);
    $username = $query->fetch()['username'];
    ?>
    <th scope="row"><?php echo $news["id"]; ?></th>
    <td><?php echo $username; ?></td>
    <td><?php echo $news["subject"]; ?></td>
    <td><?php echo $news["content"]; ?></td>
    <td><?php echo $news["send_date"]; ?></td>
</tr>