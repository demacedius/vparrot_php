<?php

define("DBHOST", getenv('DBHOST'));
define("DBUSER", getenv('DBUSER'));
define("DBPASS", getenv('DBPASSWORD'));
define("DBNAME", getenv('DBDATABASE'));

$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST . ";port=3306";

try{
    $db= new PDO($dsn, DBUSER,DBPASS);

    $db->exec("SET NAMES utf8");

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(PDOException $e){
    die("Erreur:".$e->getMessage());
}




