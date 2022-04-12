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
        // Constructor

        $this->_email = strtolower(trim($user['email']));
        $this->_username = strtolower(trim($user['username']));
        $this->_password = $user['password'];
        $this->_passwordConfirm = $user['passwordConfirm'];
        $this->_age = $user['age'];
        $this->_cgu = $user['cgu'];
        $this->_errors = [];
    }

    public function checkIntegrity($user) {
        // Check if all field are fulfill and correctly formated.
        // If not, redirect to index with errors messages.
        
        // Args:
        //     $user (Array): Data given by the user.

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

        if (count($_SESSION['errors']) != 0) {
            header('Location: ../index.php');
        }

        return true;
    }

    public function getInfo() {
        echo '<pre>';
        print_r($this);
    }

    private function checkEmail() {
        // Check if the email is correct.

        // Returns:
        //     bool: If the email is correct or no.

        if (filter_var($this->_email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        $this->_errors[] = 'Email incorrect.';
        return false;
    }

    private function checkUsername() {
        // Check if the username is correct.

        // Returns:
        //     bool: If the username is correct or no.

        if (strlen($this->_username) > 4 && strlen($this->_username) < 60) {
            return true;
        }
        $this->_errors[] = 'Nom d\'utilisateur incorrect';
        return false;
    }

    private function checkAgreement() {
        // Check if the agreement are selected.
        
        // Returns:
        //     bool: If both agreement are on.

        return ($this->_age == 'on' && $this->_cgu == 'on') ? true : false;
    }

    private function checkPassword() {
        // Check if the password is correct and match the second one.

        // Returns:
        //     bool: If the password is correct or no.

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

