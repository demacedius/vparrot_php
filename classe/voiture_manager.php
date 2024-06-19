<?php
class VoitureManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addVoiture($prix, $nom, $description, $kilometrage, $annee, $image)
    {
        try {
            echo "Début de la méthode addVoiture<br>";

        

            echo "Connexion à la base de données réussie<br>";

            // Commencer une transaction
            $this->db->beginTransaction();
            echo "Transaction commencée<br>";

            // Préparer la requête SQL avec des paramètres nommés
            $sql = "INSERT INTO `voiture` (`prix`, `kilometrage`, `annee`, `image`, `nom`, `description`) 
                VALUES (:prix, :kilometrage, :annee, :image, :nom, :description)";
            $query = $this->db->prepare($sql);
            echo "Requête SQL préparée<br>";

            // Associer les valeurs aux paramètres nommés
            $query->bindParam(':prix', $prix);
            $query->bindParam(':kilometrage', $kilometrage);
            $query->bindParam(':annee', $annee);
            $query->bindParam(':image', $image);
            $query->bindParam(':nom', $nom);
            $query->bindParam(':description', $description);
            echo "Paramètres associés<br>";

            // Afficher les valeurs des paramètres avant l'exécution pour débogage
            echo "Valeurs des paramètres : ";
            var_dump($prix, $kilometrage, $annee, $image, $nom, $description);
            echo "<br>";

            // Exécuter la requête
            $result = $query->execute();

            // Afficher le résultat de l'exécution pour débogage
            echo "Résultat de l'exécution : ";
            var_dump($result);
            echo "<br>";

            // Vérifier si la requête a réussi
            if ($result) {
                // Valider la transaction
                $this->db->commit();
                echo "Transaction validée<br>";
                return true;
            } else {
                // Annuler la transaction
                $this->db->rollBack();
                $errorInfo = $query->errorInfo();
                throw new Exception("Erreur lors de l'exécution de la requête : " . $errorInfo[2]);
            }
        } catch (Exception $e) {
            // Afficher l'erreur pour le débogage
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
}

// Connexion à la base de données
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=deMacedo_ecf', 'root', 'Amandine2412.');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à la base de données établie avec succès<br>";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}

// Utilisation de VoitureManager

?>