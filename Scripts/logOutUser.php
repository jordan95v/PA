<?php
require "functions.php";
updateUserLogs(connectDB(), $_SESSION["id"], "logout");
unset($_SESSION["email"]);
unset($_SESSION["token"]);
unset($_SESSION["username"]);
unset($_SESSION["id"]);
$_SESSION['unlogged'] = 1;
header("Location: ../index.php");
