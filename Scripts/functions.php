<?php
session_start();
require_once "config.inc.php";

function checkPassword($password1, $password2, &$errors) {
	// Check if the password is correct and match the second one.

	// Returns:
	//     bool: If the password is correct or no.

	if(strlen($password1) >= 8 && preg_match("#\d#", $password1) > 0 &&
		preg_match("#[a-z]#", $password1) > 0 && preg_match("#[A-Z]#", $password1) > 0) {
			if ($password1 != $password2){
				$errors[] = 'Les mots de passe ne correspondent pas.';
			}            
	}
	else {
		$errors[] = 'Le mot de passe doit faire plus de 8 caractères, content un chiffre et une majsucule.';
	}
}

function checkUsername($username, &$errors) {
	// Check if the username is correct.

	// Returns:
	//     bool: If the username is correct or no.

	if (strlen($username) > 4 && strlen($username) < 60) {
		return true;
	}
	$errors[] = 'Nom d\'utilisateur incorrect';
}

function checkEmail($email, &$errors) {
	// Check if the email is correct.

	// Returns:
	//     bool: If the email is correct or no.

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	$errors[] = 'Email incorrect.';
}

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