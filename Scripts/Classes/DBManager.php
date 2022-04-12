<?php
class DBManager {
    
    public function __construct() {
        $this->_pdo = connectDB();
    }

    public function addToDatabase($user) {
        $query = $this->_pdo->prepare("INSERT INTO petitchat_user (email, username, pwd) VALUES (:email, :username, :pwd);");
        $pwd = password_hash($user->getPwd(), PASSWORD_DEFAULT);
        $query->execute(["email"=>$user->getEmail(),
                        "username"=>$user->getUsername(),
                        "pwd"=>$pwd]);
    }
}
