<?php
class Authentification {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($email, $password) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Ce n'est pas une adresse email valide";
        }

        $sql = "SELECT * FROM `users` WHERE `email` = :email";

        $query = $this->db->prepare($sql);
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch();

        if (!$user) {
            return "L'utilisateur et/ou le mot de passe est incorrect";
        }

        if (!password_verify($password, $user["password"])) {
            return "L'utilisateur et/ou le mot de passe est incorrect";
        }

        session_start();

        $_SESSION["user"] = [
            "id" => $user["id"],
            "email" => $user["email"]
        ];

        return true;
    }
}

