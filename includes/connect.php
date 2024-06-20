<?php
$host_name = 'db5015928952.hosting-data.io';
$database = 'dbs12982473';
$user_name = 'dbu4637891';
$password = 'L337(0[)e43v3r';
$dbh = null;

try {
    $dbh = new PDO("mysql:host=$host_name;dbname=$database;", $user_name, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur!:" . $e->getMessage() . "<br/>";
    die();
}
?>


