<?php
class MessageUtilisateur {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertMessage($nom, $prenom, $email, $telephone, $message, $voiture_id) {
        $sql = "INSERT INTO `messageUtilisateur` (`nom`, `prenom`, `email`, `telephone`, `message`, `voiture_id`) 
                VALUES (:nom, :prenom, :email, :telephone, :message, :voiture_id)";
        $query = $this->db->prepare($sql);
        $query->bindValue(":nom", $nom, PDO::PARAM_STR);
        $query->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $query->bindValue(":email", $email, PDO::PARAM_STR);
        $query->bindValue(":telephone", $telephone, PDO::PARAM_STR);
        $query->bindValue(":message", $message, PDO::PARAM_STR);
        $query->bindValue(":voiture_id", $voiture_id, PDO::PARAM_INT);
        return $query->execute();
    }
}

