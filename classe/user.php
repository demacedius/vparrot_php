<?php

require_once __DIR__ . '/../includes/connect.php';

class User
{
    public static function authenticate($email, $password)
    {
        global $db; // Connexion à la base de données

        // Requête pour récupérer l'utilisateur en fonction de l'email
        $sql = "SELECT * FROM `users` WHERE `email` = :email";
        $query = $db->prepare($sql);
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->execute();
        $user = $query->fetch();

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return false;
        }

        // Vérifier si le mot de passe est correct
        if (!password_verify($password, $user["password"])) {
            return false;
        }

        // Authentification réussie
        return $user;
    }
}
