<?php
session_start();
require_once "config.inc.php";

function connectDB()
{
	try {
		$pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PWD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die("Erreur SQL." . $e->getMessage());
	}
	return $pdo;
}

function isConnected() {
	if (!isset($_SESSION["email"]) || !isset($_SESSION["token"])) {
		return false;
	}
	$queryPrepared = $this->_pdo->prepare("SELECT id FROM petitchat_user WHERE email=:email AND token=:token");
	$queryPrepared->execute(["email" => $_SESSION["email"], "token" => $_SESSION["token"]]);
	return $queryPrepared->fetch();
}

function createToken() {
	$token = sha1(md5(rand(0, 100) . "gdgfm432") . uniqid());
	return $token;
}

function updateToken($userId, $token) {
	$queryPrepared = $this->_pdo->prepare("UPDATE petitchat_user SET token=:token WHERE id=:id");
	$queryPrepared->execute(["token" => $token, "id" => $userId]);
}