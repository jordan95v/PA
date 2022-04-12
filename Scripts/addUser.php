<?php 

require 'Classes/UserManager.php';

$client = new UserManager($_POST);
$client->checkIntegrity($_POST);

echo $client->getInfo();