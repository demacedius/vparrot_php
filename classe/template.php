<?php
class Template {

    private $userEmail;

    public function __construct($userEmail) {
        $this->userEmail = $userEmail;
    }
    
    public static function header($titre) {
        include ("./includes/header.php");
    }

    public static function nav() {
        include( "./includes/nav.php");
    }

    public static function footer() {
        include ("./includes/footer.php");
    }
}
