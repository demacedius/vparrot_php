<?php

define("DBHOST","127.0.0.1");
define("DBUSER","root");
define("DBPASS","Amandine2412.");
define("DBNAME","deMacedo_ecf");

$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST . ";port=3306";

try{
    $db= new PDO($dsn, DBUSER,DBPASS);

    $db->exec("SET NAMES utf8");

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(PDOException $e){
    die("Erreur:".$e->getMessage());
}




