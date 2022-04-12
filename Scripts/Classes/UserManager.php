<?php
session_start();
require 'functions.php';

class UserManager {
    private $_email;
    private $_username;
    private $_password;
    private $_passwordConfirm;
    private $_age;
    private $_cgu;

    public function __construct($user) {
        $this->_email = strtolower(trim($user['email']));
        $this->_username = strtolower(trim($user['username']));
        $this->_password = $user['password'];
        $this->_passwordConfirm = $user['passwordConfirm'];
        $this->_age = $user['age'];
        $this->_cgu = $user['cgu'];
        $this->_errors = [];
    }

    public function addToDatabase() {
        $this->_pdo->prepare("INSERT INTO petitchat_user (email, pseudo, pwd) 
		VALUES (:email, :pseudo, :pwd)");
    }

    public function checkIntegrity($user) {
        if (!empty($user['email']) &&
            !empty($user['username']) &&
            !empty($user['password']) &&
            !empty($user['passwordConfirm']) &&
            !empty($user['age']) && 
            !empty($user['cgu']) &&
            count($user) == 6){
                $this->checkEmail();
                $this->checkUsername();
                $this->checkPassword();
                $this->checkAgreement();
        }
        $_SESSION['errors'] = $this->_errors;
        header('Location: ../index.php');
    }

    public function getInfo() {
        echo '<pre>';
        print_r($this);
    }

    private function checkEmail() {
        if (filter_var($this->_email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        $this->_errors[] = 'Email incorrect.';
        return false;
    }

    private function checkUsername() {
        if (strlen($this->_username) > 4 && strlen($this->_username) < 60) {
            return true;
        }
        $this->_errors[] = 'Nom d\'utilisateur incorrect';
        return false;
    }

    private function checkAgreement() {
        return ($this->_age == 'on' && $this->_cgu == 'on') ? true : false;
    }

    private function checkPassword() {
        if(strlen($this->_password) >= 8 && preg_match("#\d#", $this->_password) > 0 &&
            preg_match("#[a-z]#", $this->_password) > 0 && preg_match("#[A-Z]#", $this->_password) > 0) {
                if ($this->_password == $this->_passwordConfirm){
                    return true;
                }            
            $this->_errors[] = 'Les mots de passe ne correspondent pas.';
        }
        $this->_errors[] = 'Le mot de passe doit faire plus de 8 caractères, content un chiffre et une majsucule.';
        return false;
    }
}

