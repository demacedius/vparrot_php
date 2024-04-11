<?php
class UserManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function loginUser($email, $password) {
        $sql = "SELECT * FROM `users` WHERE `email` = :email";

        $query = $this->db->prepare($sql);

        $query->bindValue(":email", $email, PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user["password"])) {
            return false;
        }

        return $user;
    }
}

