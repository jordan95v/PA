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
	$query = $pdo->prepare("SELECT id FROM petitchat_user WHERE email=:email AND token=:token;");
	$query->execute(["email" => $_SESSION["email"], "token" => $_SESSION["token"]]);
	if ($query->fetch()) {
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


	$query = $pdo->prepare("UPDATE petitchat_user SET token=:token WHERE id=:id;");
	$query->execute(["token" => $token, "id" => $id]);
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
		$query = $pdo->prepare("SELECT * FROM petitchat_user WHERE email=:email AND statut=:statut;");
		$query->execute(["email" => $email, "statut" => 1]);
		$results = $query->fetch();

		if (!empty($results)) {
			if (!isBanned($pdo, $email)) {
				if (password_verify($pwd, $results["pwd"])) {
					$token = createToken();
					updateToken($results["id"], $token, $pdo);
					$_SESSION["email"] = $email;
					$_SESSION["token"] = $token;
					$_SESSION["username"] = $results["username"];
					$_SESSION["id"] = $results["id"];
				} else {
					$errors[] = "Identifiants incorrects.";
				}
			} else {
				$_SESSION['banned'] = 1;
				header("Location: ../index.php");
				die();
			}
		} else {
			$errors[] = "Veuillez confirmez votre adresse email pour vous connecter.";
		}
	} else {
		$errors[] = "Vous devez remplir tout les champs.";
	}
}

function isAdmin($pdo)
{
	// Check if a user is admin or no.

	// Args:
	// 	pdo (PDO): The instance of PDO.

	// Returns:
	// 	bool: If the user is admin or no.


	if (!isset($_SESSION["email"]) || !isset($_SESSION["token"])) {
		return false;
	}
	$query = $pdo->prepare("SELECT id FROM petitchat_user WHERE email=:email AND token=:token AND is_admin=:is_admin;");
	$query->execute(["email" => $_SESSION["email"], "token" => $_SESSION["token"], "is_admin" => 1]);
	if ($query->fetch()) {
		return true;
	}
	return false;
}

function updateLogs($pdo, $view)
{
	$query = $pdo->prepare("SELECT * FROM grandcanard_logs WHERE view=:view");
	$query->execute(["view" => $view]);
	if (!empty($query->fetch())) {
		$query = $pdo->prepare("UPDATE grandcanard_logs SET connection=connection+1 WHERE view=:view");
		$query->execute(["view" => $view]);
	} else {
		$query = $pdo->prepare("INSERT INTO grandcanard_logs (view, connection) VALUES (:view, :nbr);");
		$query->execute(["view" => $view, "nbr" => 1]);
	}
}

function updateUserLogs($pdo, $id, $type)
{
	$query = $pdo->prepare("INSERT INTO moyenlezard_user_logs (type, user_id) VALUES (:type, :user_id);");
	$query->execute(["type" => $type, "user_id" => $id]);
}

function updateNews($pdo, $id, $sub, $content)
{
	$query = $pdo->prepare("INSERT INTO minisculecome_newsletter (user_id, subject, content) VALUES (:user_id, :sub, :content);");
	$query->execute(["user_id" => $id, "sub" => $sub, "content" => $content]);
}

function isBanned($pdo, $email)
{
	// Check if a user is admin or no.

	// Args:
	// 	pdo (PDO): The instance of PDO.

	// Returns:
	// 	bool: If the user is admin or no.

	$query = $pdo->prepare("SELECT id FROM petitchat_user WHERE email=:email AND banned=:banned;");
	$query->execute(["email" => $email, "banned" => 1]);
	if ($query->fetch()) {
		return true;
	}
	return false;
}

function getUserId($pdo)
{

	$query = $pdo->prepare('SELECT id FROM petitchat_user WHERE token=:token');
	$query->execute(["token" => $_SESSION["token"]]);

	return $query->fetch()[0];
}
