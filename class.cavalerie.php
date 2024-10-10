<?php
class Cavalerie {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function ajouterCavalier($nomche, $datenache, $garrot, $idrace, $idrobe) {
        // Vérification de l'existence de la race
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM race WHERE idrace = ?");
        $stmt->execute([$idrace]);
        if ($stmt->fetchColumn() == 0) {
            throw new Exception("La race sélectionnée n'existe pas.");
        }

        // Vérification de l'existence de la robe
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM robe WHERE idrobe = ?");
        $stmt->execute([$idrobe]);
        if ($stmt->fetchColumn() == 0) {
            throw new Exception("La robe sélectionnée n'existe pas.");
        }

        // Insertion du cavalier
        $stmt = $this->db->prepare("INSERT INTO cavalerie (nomche, datenache, garrot, idrace, idrobe) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nomche, $datenache, $garrot, $idrace, $idrobe]);
    }
}
