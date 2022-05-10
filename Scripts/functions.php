<?php
session_start();
require_once "config.inc.php";

function connectDB()
{
	// Create an instance of PDO.

	try {
		$pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT, DB_USER, DB_PWD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		die("Erreur SQL." . $e->getMessage());
	}
	return $pdo;
}

function isConnected($pdo)
{
	// Check if a user is connected or no.

	// Args:
	// 	pdo (PDO): The instance of PDO.

	if (!isset($_SESSION["email"]) || !isset($_SESSION["token"])) {
		return false;
	}
	$queryPrepared = $pdo->prepare("SELECT id FROM petitchat_user WHERE email=:email AND token=:token");
	$queryPrepared->execute(["email" => $_SESSION["email"], "token" => $_SESSION["token"]]);
	if ($queryPrepared->fetch()) {
		return true;
	}
	return false;
}

function createToken()
{
	// Create a new token.

	$token = sha1(md5(rand(0, 100) . "gdgfm432") . uniqid());
	return $token;
}

function updateToken($id, $token, $pdo)
{
	// Update the token.

	// Args:
	//	id(int): The id of the user.
	// 	token (str): The new token.
	// 	pdo (PDO): The instance of PDO.


	$queryPrepared = $pdo->prepare("UPDATE petitchat_user SET token=:token WHERE id=:id");
	$queryPrepared->execute(["token" => $token, "id" => $id]);
}

function connectUser($email, $pwd, $pdo, &$errors)
{
	// Connect the user.

	// Args:
	// 	email (str): The email of the user.
	//	pwd (str): The password entered by the user.
	// 	pdo (PDO): The instance of PDO.
	//	error (list[str]): List all of the errors.

	if ($email && $pwd) {
		$queryPrepared = $pdo->prepare("SELECT * FROM petitchat_user WHERE email=:email AND statut=:statut");
		$queryPrepared->execute(["email" => $email, "statut" => 1]);
		$results = $queryPrepared->fetch();

		if (!empty($results)) {
			if (password_verify($pwd, $results["pwd"])) {
				$token = createToken();
				updateToken($results["id"], $token, $pdo);
				$_SESSION["email"] = $email;
				$_SESSION["token"] = $token;
				$_SESSION["username"] = $results["username"];
			}
			else {
				$errors[] = "Identifiants incorrects.";
			}
		}
		else {
			$errors[] = "Veuillez confirmez votre adresse email pour vous connecter.";
		}
	}
}

function isAdmin($pdo) {
	// Check if a user is admin or no.

	// Args:
	// 	pdo (PDO): The instance of PDO.
	
	// Returns:
	// 	bool: If the user is admin or no.
	

	if (!isset($_SESSION["email"]) || !isset($_SESSION["token"])) {
		return false;
	}
	$queryPrepared = $pdo->prepare("SELECT id FROM petitchat_user WHERE email=:email AND token=:token AND is_admin=:is_admin");
	$queryPrepared->execute(["email" => $_SESSION["email"], "token" => $_SESSION["token"], "is_admin"=>1]);
	if ($queryPrepared->fetch()) {
		return true;
	}
	return false;
}