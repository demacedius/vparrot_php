<?php
require_once 'user.php';

class AuthController
{
    public static function login()
    {
        // Check if the session is already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!empty($_POST)) {
            if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
                $email = strip_tags($_POST["email"]);
                if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                    die("L'adresse email est incorrecte");
                }

                $user = User::authenticate($_POST["email"], $_POST["password"]);

                if (!$user) {
                    die("L'utilisateur et/ou le mot de passe sont incorrects");
                }

                // Authentication successful, store user information in session
                $_SESSION["user"] = ["id" => $user["id"], "email" => $user["email"]];

                // Redirect to dashboard.php
                header("Location: ./../dashboard.php");
                exit(); // Ensure no further output is sent
            }
        }
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
AuthController::login();
}
?>
