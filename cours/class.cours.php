<?php
require_once '../include/bdd.inc.php';

class Cours {
    private $db;

    public function __construct() {
        $this->db = connexionPDO();
    }

    // Créer un cours
    public function create($libcours, $hdebut, $hfin) {
        $stmt = $this->db->prepare("INSERT INTO cours (libcours, hdebut, hfin) VALUES (:libcours, :hdebut, :hfin)");
        $stmt->execute(['libcours' => $libcours, 'hdebut' => $hdebut, 'hfin' => $hfin]);
    }

    // Lire tous les cours
    public function read() {
        $stmt = $this->db->query("SELECT * FROM cours");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lire un cours par ID
    public function readById($idcours) {
        $stmt = $this->db->prepare("SELECT * FROM cours WHERE idcours = :idcours");
        $stmt->execute(['idcours' => $idcours]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour un cours
    public function update($idcours, $libcours, $hdebut, $hfin) {
        $stmt = $this->db->prepare("UPDATE cours SET libcours = :libcours, hdebut = :hdebut, hfin = :hfin WHERE idcours = :idcours");
        $stmt->execute(['libcours' => $libcours, 'hdebut' => $hdebut, 'hfin' => $hfin, 'idcours' => $idcours]);
    }

    // Supprimer un cours
    public function delete($idcours) {
        $stmt = $this->db->prepare("DELETE FROM cours WHERE idcours = :idcours");
        $stmt->execute(['idcours' => $idcours]);
    }
}
?>
