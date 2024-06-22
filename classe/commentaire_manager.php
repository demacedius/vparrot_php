<?php
class CommentaireManager {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function getAllCommentaires() {
        $sql = "SELECT * FROM `commentaire`";
        $requete = $this->dbh->query($sql);
        return $requete->fetchAll();
    }

    public function validerCommentaire($commentaire_id) {
        $sql = "UPDATE `commentaire` SET `valider` = 1 WHERE `id` = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([$commentaire_id]);
    }
    public function deleteComment($commentaire_id) {
        $sql = "DELETE FROM `commentaire` WHERE `id` = ?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([$commentaire_id]);
    }
}

