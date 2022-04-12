<?php

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

	if (strlen($username) < 4 && strlen($username) > 60) {
	    $errors[] = 'Nom d\'utilisateur incorrect';	
	}
}

function checkEmail($email, &$errors) {
	// Check if the email is correct.

	// Returns:
	//     bool: If the email is correct or no.

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	    $errors[] = 'Email incorrect.';	
	}
}

function checkEmailExist($email, $pdo, &$errors) {
	$queryPrepared = $pdo->prepare("SELECT id from petitchat_user WHERE email=:email");
	$queryPrepared->execute(["email" => $email]);
	if (!empty($queryPrepared->fetch())) {
		$errors[] = "L'email existe déjà en bdd";
	}
}

function checkUsernameExist($username, $pdo, &$errors) {
	$queryPrepared = $pdo->prepare("SELECT id from petitchat_user WHERE username=:username");
	$queryPrepared->execute(["username" => $username]);
	if (!empty($queryPrepared->fetch())) {
		$errors[] = "Ce nom d'utilisateur.";
	}
}