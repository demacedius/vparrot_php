<?php
class MessageUtilisateurManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllMessages() {
        $sql = "SELECT * FROM `messageUtilisateur`";
        $requete = $this->db->query($sql);
        return $requete->fetchAll();
    }
}
?>
