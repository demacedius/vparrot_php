<?php
class CommentaireManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCommentaires() {
        $sql = "SELECT * FROM `commentaire`";
        $requete = $this->db->query($sql);
        return $requete->fetchAll();
    }

    public function validerCommentaire($commentaire_id) {
        $sql = "UPDATE `commentaire` SET `valider` = 1 WHERE `id` = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$commentaire_id]);
    }
}

