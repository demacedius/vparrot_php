<?php
class VoitureManager {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addVoiture($prix, $nom, $description, $kilometrage, $annee, $image) {
        $sql = "INSERT INTO `voiture` (`prix`,`kilometrage`,`annee`,`image`,`nom`,`description`) VALUES (?, ?, ?, ?, ?, ?)";
        $query = $this->db->prepare($sql);
        return $query->execute([$prix, $kilometrage, $annee, $image, $nom, $description]);
    }
}
