<?php
class Annonce {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAnnonceById($id) {
        $sql = "SELECT * FROM `voiture` WHERE `id` = :annonce_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':annonce_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
