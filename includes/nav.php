<?php
require_once "./classe/navigation.php";

Navigation::afficherNav(isset($_SESSION["user"]));
