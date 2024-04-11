<?php
class SessionManager {
    public static function startSession() {
        session_start();
    }

    public static function setUserSession($userData) {
        $_SESSION["user"] = [
            "id" => $userData["id"],
            "email" => $userData["email"]
        ];
    }
}

