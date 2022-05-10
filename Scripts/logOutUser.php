<?php
	session_start();
	unset($_SESSION["email"]);
	unset($_SESSION["token"]);
	$_SESSION['unlogged'] = 1;
	header("Location: ../index.php");
