<?php

$servername = "127.0.0.1";
$username = "root";
$password = "Amandine2412.";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la base de données
    $sql = "CREATE DATABASE IF NOT EXISTS deMacedo_ecf";
    $conn->exec($sql);
    echo "Base de données créée avec succès.\n";

    // Utilisation de la base de données
    $conn->exec("USE deMacedo_ecf");

    // Création de la table commentaire
    $sql = "CREATE TABLE IF NOT EXISTS commentaire (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        commentaire TEXT NOT NULL,
        note INT,
        valider BOOLEAN DEFAULT 0
    )";
    $conn->exec($sql);
    echo "Table commentaire créée avec succès.\n";

    // Création de la table users
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    )";
    $conn->exec($sql);
    echo "Table users créée avec succès.\n";

    // Création de la table voiture
    $sql = "CREATE TABLE IF NOT EXISTS voiture (
        id INT AUTO_INCREMENT PRIMARY KEY,
        prix DECIMAL(10,2) NOT NULL,
        kilometrage INT NOT NULL,
        annee INT NOT NULL,
        image VARCHAR(255) NOT NULL,
        nom VARCHAR(255) NOT NULL,
        description TEXT NOT NULL
    )";
    $conn->exec($sql);
    echo "Table voiture créée avec succès.\n";

    // Création de la table messageUtilisateur
    $sql = "CREATE TABLE IF NOT EXISTS messageUtilisateur (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(255) NOT NULL,
        prenom VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        numero_telephone VARCHAR(20) NOT NULL,
        message TEXT NOT NULL,
        voiture_id INT,
        FOREIGN KEY (voiture_id) REFERENCES voiture(id)
    )";
    $conn->exec($sql);
    echo "Table messageUtilisateur créée avec succès.\n";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;

?>