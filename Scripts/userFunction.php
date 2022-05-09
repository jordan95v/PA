<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

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
			$errors[] = 'Les mots de passe ne correspondent pas.';
			return false;
		}
	} else {
		$errors[] = 'Le mot de passe doit faire plus de 8 caractères, content un chiffre et une majsucule.';
		return false;
	}
	return true;
}

function checkUsername($username, &$errors)
{
	// Check if the username is correct.

	// Returns:
	//     bool: If the username is correct or no.

	if (strlen($username) < 4 && strlen($username) > 60) {
		$errors[] = 'Nom d\'utilisateur incorrect';
	}
}

function checkEmail($email, &$errors)
{
	// Check if the email is correct.

	// Returns:
	//     bool: If the email is correct or no.

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'Email incorrect.';
	}
}

function checkEmailExist($email, $pdo, &$errors, $token = null)
{
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

function sendConfirmMail($to, $cle, &$errors)
{
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->isSMTP();                                            
		$mail->Host       = 'smtp.gmail.com';                     
		$mail->SMTPAuth   = true;                                   
		$mail->Username   = 't36tt3st@gmail.com';                     
		$mail->Password   = 'Test12345+';                               
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
		$mail->Port       = 465;                                   

		//Recipients
		$mail->setFrom('t36tt3st@gmail.com', 'Les Lumieres');
		$mail->addAddress($to);                 				

		//Content
		$mail->isHTML(true);                                 
		$mail->Subject = 'Mail de confirmation pour Les Lumieres !';
		$mail->Body    = 'Cliquez sur le lien pour confirmez votre email.<br><a href="http://localhost/PA/Scripts/verif.php?cle='.$cle.'">Lien de confirmation</a>';
		$mail->send();
	} catch (Exception $e) {
		$errors[] = 'Echec lors de l\'envoie du mail, veuillez réessayer.';
	}
}
