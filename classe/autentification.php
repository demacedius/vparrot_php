<?php

require_once 'user.php';

class AuthController
{
    public static function login()
    {
        session_start();

        if (!empty($_POST)) {
            if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["password"]) && !empty($_POST["password"])) {
                $email = strip_tags($_POST["email"]);
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    die("l'adresse email est incorrecte");
                }

                $user = User::authenticate($_POST["email"], $_POST["password"]);

                if (!$user) {
                    die("L'utilisateur et/ou le mot de passe sont incorrects");
                }

                $_SESSION["user"] = ["id" => $user["id"], "email" => $user["email"]];

                header("location: dashboard.php");
            }
        }
    }
}