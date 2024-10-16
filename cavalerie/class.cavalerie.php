<?php

include_once '../include/bdd.inc.php';

class Cavalerie {
    private $numsire;
    private $nomche;
    private $datenache;
    private $garrot;
    private $idrace;
    private $idrobe;

    public function __construct($numsire = null, $nomche = null, $datenache = null, $garrot = null, $idrace = null, $idrobe = null) {
        $this->numsire = $numsire;
        $this->nomche = $nomche;
        $this->datenache = $datenache;
        $this->garrot = $garrot;
        $this->idrace = $idrace;
        $this->idrobe = $idrobe;
    }

    public function getCavaleries() {
        $con = connexionPDO();
        $sql = "SELECT c.*, r.librace, b.librobe 
                FROM cavalerie c 
                JOIN race r ON c.idrace = r.idrace 
                JOIN robe b ON c.idrobe = b.idrobe 
                WHERE c.supprime = 0";
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCavalier($nomche, $datenache, $garrot, $idrace, $idrobe) {
        $con = connexionPDO();
        $sql = "INSERT INTO cavalerie (nomche, datenache, garrot, idrace, idrobe) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        return $stmt->execute([$nomche, $datenache, $garrot, $idrace, $idrobe]);
    }

    public function updateCavalier($numsire, $nomche, $datenache, $garrot, $idrace, $idrobe) {
        $con = connexionPDO();
        $sql = "UPDATE cavalerie SET nomche = ?, datenache = ?, garrot = ?, idrace = ?, idrobe = ? WHERE numsire = ?";
        $stmt = $con->prepare($sql);
        return $stmt->execute([$nomche, $datenache, $garrot, $idrace, $idrobe, $numsire]);
    }

    public function deleteCavalier($numsire) {
        $con = connexionPDO();
        $sql = "UPDATE cavalerie SET supprime = 1 WHERE numsire = ?";
        $stmt = $con->prepare($sql);
        return $stmt->execute([$numsire]);
    }

    // Additional functions for autocomplete and other features can be added here.
}

?>
