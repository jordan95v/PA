<tr>
    <?php
    $query = $pdo->prepare("SELECT username FROM petitchat_user WHERE id=:id");
    $query->execute(["id" => $news["user_id"]]);
    $username = $query->fetch()['username'];
    ?>
    <th scope="row"><?php echo $news["id"]; ?></th>
    <td id="username"><?php echo $username; ?></td>
    <td id="subject"><?php echo $news["subject"]; ?></td>
    <td id="content"><?php echo $news["content"]; ?></td>
    <td id="send-date"><?php echo $news["send_date"]; ?></td>
</tr>