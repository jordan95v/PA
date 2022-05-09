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

function isConnected($pdo)
{
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
	$token = sha1(md5(rand(0, 100) . "gdgfm432") . uniqid());
	return $token;
}

function updateToken($userId, $token, $pdo)
{
	$queryPrepared = $pdo->prepare("UPDATE petitchat_user SET token=:token WHERE id=:id");
	$queryPrepared->execute(["token" => $token, "id" => $userId]);
}

function connectUser($email, $pwd, $pdo, &$errors)
{
	if ($email && $pwd) {
		$queryPrepared = $pdo->prepare("SELECT * FROM petitchat_user WHERE email=:email");
		$queryPrepared->execute(["email" => $email]);
		$results = $queryPrepared->fetch();

		if (!empty($results) && password_verify($pwd, $results['pwd'])) {
			if ($result['status'] != 1)
			{
				$errors[] = 'Email non confirmé.';
			}
			else {
				$token = createToken();
				updateToken($results["id"], $token, $pdo);
				//Insertion dans la session du token
				$_SESSION['email'] = $email;
				$_SESSION['token'] = $token;
				$_SESSION['username'] = $results['username'];
			}
			
		} else {
			$errors[] = 'Identifiants incorrects.';
		}
	}
}
