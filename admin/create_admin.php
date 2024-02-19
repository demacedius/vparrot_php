<?php

require_once("includes/connect.php");

try {
    

    // Hasher le mot de passe
    $hashedPassword = password_hash("azerty", PASSWORD_DEFAULT);

    // Insérer l'utilisateur dans la table users
    $sql = "INSERT INTO `users` (`email`, `password`) VALUES (:email, :password)";
    $query = $db->prepare($sql);
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $hashedPassword);

    $email = "vparrot@vparrot.fr";  // Adresse e-mail de l'utilisateur
    $query->execute();

    echo "Utilisateur ajouté avec succès.\n";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}


?>
