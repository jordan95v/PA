<?php

use PHPMailer\PHPMailer\PHPMailer;

require "PHPMailer/src/Exception.php";
require "PHPMailer/src/PHPMailer.php";
require "PHPMailer/src/SMTP.php";
require "config.inc.php";

function checkPassword($password1, $password2, &$errors)
{
	// Check if the password is correct and match the second one.

	// Returns:
	//     bool: If the password is correct or no.

	if (
		strlen($password1) >= 8 && preg_match("#\d#", $password1) > 0 &&
		preg_match("#[a-z]#", $password1) > 0 && preg_match("#[A-Z]#", $password1) > 0
	) {
		if ($password1 != $password2) {
			$errors[] = "Les mots de passe ne correspondent pas.";
			return false;
		}
	} else {
		$errors[] = "Le mot de passe doit faire plus de 8 caractères, content un chiffre et une majsucule.";
		return false;
	}
	return true;
}

function checkUsername($username, &$errors)
{
	// Check if the username is correct.

	// Args:
	//	username (str): The username to check.

	// Returns:
	//     bool: If the username is correct or no.

	if (strlen($username) < 4 && strlen($username) > 60) {
		$errors[] = "Nom d'utilisateur incorrect";
	}
}

function checkEmail($email, &$errors)
{
	// Check if the email is correct.

	// Args:
	//	email (str): The email to check.

	// Returns:
	//     bool: If the email is correct or no.

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Email incorrect.";
	}
}

function checkEmailExist($email, $pdo, &$errors, $token = null)
{
	// Check if the email already exists.

	// Args:
	//	email(str): The email to check.
	// 	pdo (PDO): The instance of PDO.
	//	error (list[str]): List all of the errors.
	//	token (str): Token to search.

	if ($token != null) {
		$queryPrepared = $pdo->prepare("SELECT id from petitchat_user WHERE email=:email AND token!=:token");
		$queryPrepared->execute(["email" => $email, "token" => $token]);
	} else {
		$queryPrepared = $pdo->prepare("SELECT id from petitchat_user WHERE email=:email");
		$queryPrepared->execute(["email" => $email]);
	}
	if (!empty($queryPrepared->fetch())) {
		$errors[] = "L'email existe déjà en bdd.";
	}
}

function checkUsernameExist($username, $pdo, &$errors, $token = null)
{
	// Check if the username already exists.

	// Args:
	//	username(str): The username to check.
	// 	pdo (PDO): The instance of PDO.
	//	error (list[str]): List all of the errors.
	//	token (str): Token to search.

	if ($token != null) {
		$queryPrepared = $pdo->prepare("SELECT id from petitchat_user WHERE username=:username AND token!=:token");
		$queryPrepared->execute(["username" => $username, "token" => $token]);
	} else {
		$queryPrepared = $pdo->prepare("SELECT id from petitchat_user WHERE username=:username");
		$queryPrepared->execute(["username" => $username]);
	}
	if (!empty($queryPrepared->fetch())) {
		$errors[] = "Ce nom d'utilisateur existe déjà.";
	}
}

function sendUserMail($to, $title, $body, &$errors)
{
	$mail = new PHPMailer();
	$mail->SMTPDebug = 2;
	$mail->IsSMTP();
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;
	$mail->SMTPAuth = true;
	$mail->Username = EMAIL;
	$mail->Password = PWD;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->Host = 'smtp-mail.outlook.com';
	$mail->IsHTML(true);
	$mail->From = EMAIL;
	$mail->FromName = "Les Lumieres";
	$mail->Sender = EMAIL;
	$mail->AddReplyTo(EMAIL, "Les Lumières");
	$mail->Subject = $title;
	$mail->Body = $body;
	$mail->AddAddress($to);
	// $mail->send();

	if (!$mail->Send()) {
		$errors[] = 'Erreur lors de l\'envoi du mail.';
		die();
	}
}

function sendNewsMail($title, $body, $emails, &$errors)
{
	// Send a confirmation mail.

	// Args:
	//	to (str): Email to send.
	//	confirmKey(int): confirmKey of the confirmation mail.
	//	error (list[str]): List all of the errors.


	$mail = new PHPMailer();
	$mail->SMTPDebug = 2;
	$mail->IsSMTP();
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	$mail->Host = 'smtp-mail.outlook.com';
	$mail->Port = 587;
	$mail->Username = EMAIL;
	$mail->Password = PWD;
	$mail->IsHTML(true);
	$mail->From = EMAIL;
	$mail->FromName = "Les Lumieres";
	$mail->Sender = EMAIL;
	$mail->AddReplyTo(EMAIL, "Les Lumières");
	$mail->Subject = $title;
	$mail->Body = $body;

	for ($i = 0; $i < count($emails); $i++) {
		$mail->addCC($emails[$i]);
	}

	if (!$mail->Send()) {
		$errors[] = 'Erreur lors de l\'envoi de la newsletter.';
		die();
	}
}

function sendTicket($to, $title, $body, $img, &$errors)
{
	// Send a confirmation mail.

	// Args:
	//	to (str): Email to send.
	//	confirmKey(int): confirmKey of the confirmation mail.
	//	error (list[str]): List all of the errors.


	$mail = new PHPMailer();
	$mail->SMTPDebug = 0;
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);
	$mail->SMTPSecure = 'tls';
	$mail->Host = 'smtp-mail.outlook.com';
	$mail->Port = 587;
	$mail->Username = EMAIL;
	$mail->Password = PWD;
	$mail->IsHTML(true);
	$mail->From = EMAIL;
	$mail->FromName = "Les Lumieres";
	$mail->Sender = EMAIL;
	$mail->AddReplyTo(EMAIL, "Les Lumières");
	$mail->addEmbeddedImage($img, "barcode");
	$mail->Subject = $title;
	$mail->Body = $body;
	$mail->AddAddress($to);

	if (!$mail->Send()) {
		$errors[] = 'Erreur lors de l\'envoi de la newsletter.';
	}
}
