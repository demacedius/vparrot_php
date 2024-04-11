<?php
require_once("classe/navigation.php");
session_start();
Navigation::afficherNav(isset($_SESSION["user"]));
