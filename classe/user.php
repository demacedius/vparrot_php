<?php

require_once '../includes/database.php';

class User
{
    public static function authenticate($email, $password)
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT id, email, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
}
?>