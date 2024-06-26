<?php
class VoitureManager
{
    private $dbh;

    public function __construct($db)
    {
        $dbInstance = Database::getInstance();
	$this->dbh = $dbInstance->getConnection();
    }

    public function addVoiture($prix, $nom, $description, $kilometrage, $annee, $image)
    {
        try {
           
            $this->dbh->beginTransaction();
           

           
            $sql = "INSERT INTO `voiture` (`prix`, `kilometrage`, `annee`, `image`, `nom`, `description`) 
                VALUES (:prix, :kilometrage, :annee, :image, :nom, :description)";
            $query = $this->dbh->prepare($sql);
           

            // Associer les valeurs aux paramètres nommés
            $query->bindParam(':prix', $prix);
            $query->bindParam(':kilometrage', $kilometrage);
            $query->bindParam(':annee', $annee);
            $query->bindParam(':image', $image);
            $query->bindParam(':nom', $nom);
            $query->bindParam(':description', $description);
           

            // Afficher les valeurs des paramètres avant l'exécution pour débogage
           

            // Exécuter la requête
            $result = $query->execute();

           

            // Vérifier si la requête a réussi
            if ($result) {
                // Valider la transaction
                $this->dbh->commit();
                echo "Transaction validée<br>";
                return true;
            } else {
                // Annuler la transaction
                $this->dbh->rollBack();
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


?>
