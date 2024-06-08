<?php

define("DBHOST","db5015928952.hosting-data.io");
define("DBUSER","dbu4637891");
define("DBPASS","L337(0[)e43v3r");
define("DBNAME","dbs12982473");

$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST . ";port=3306";

try{
    $db= new PDO($dsn, DBUSER,DBPASS);

    $db->exec("SET NAMES utf8");

    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

}catch(PDOException $e){
    die("Erreur:".$e->getMessage());
}




