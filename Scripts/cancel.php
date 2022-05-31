<?php
require "functions.php";

$_SESSION['notSell'] = 1;
header("Location: ../index.php");
