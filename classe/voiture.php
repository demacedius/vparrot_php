<?php
class Voiture {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllVoitures($tri) {
        $triValide = in_array($tri, ['nom', 'prix', 'kilometrage', 'annee']);
        if (!$triValide) {
            $tri = 'nom';
        }

        $sql = "SELECT * FROM `voiture` ORDER BY $tri";
        $requete = $this->db->query($sql);
        return $requete->fetchAll();
    }
}
?>
