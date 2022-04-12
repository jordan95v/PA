<?php
session_start();
require 'functions.php';

class DBManager {
    private function isConnected() {
        if (!isset($_SESSION["email"]) || !isset($_SESSION["token"])) {
            return false;
        }
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("SELECT id FROM petitchat_user WHERE email=:email AND token=:token");
        $queryPrepared->execute(["email" => $_SESSION["email"], "token" => $_SESSION["token"]]);
        return $queryPrepared->fetch();
    }

    private function createToken() {
        $token = sha1(md5(rand(0, 100) . "gdgfm432") . uniqid());
        return $token;
    }

    private function updateToken($userId, $token) {
    
        $pdo = connectDB();
        $queryPrepared = $pdo->prepare("UPDATE petitchat_user SET token=:token WHERE id=:id");
        $queryPrepared->execute(["token" => $token, "id" => $userId]);
    }
}