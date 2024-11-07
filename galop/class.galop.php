<?php
include_once '../include/bdd.inc.php';

class Galop {
    private $idgalop;
    private $libgalop;

    public function __construct($idgalop = null, $libgalop = null) {
        $this->idgalop = $idgalop;
        $this->libgalop = $libgalop;
    }

    // Getters
    public function getidgalop() {
        return $this->idgalop;
    }

    public function getlibgalop() {
        return $this->libgalop;
    }

    // Setters
    public function setlibgalop($libgalop) {
        $this->libgalop = $libgalop;
    }

    // Method to retrieve all galops
    public function GalopALL() {
        $con = connexionPDO();
        $sql = "SELECT * FROM galop WHERE supprime = 0;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to add a new galop
    public function galopAjout($libgalop) {
        $con = connexionPDO();
        $sql = "INSERT INTO galop (libgalop) VALUES (:libgalop);";
        $stmt = $con->prepare($sql);
        $data = [':libgalop' => $libgalop];
        
        if ($stmt->execute($data)) {
            return $con->lastInsertId();
        } else {
            return false;
        }
    }

    // Method to update an existing galop
    public function Modifier($id, $libgalop) {
        $con = connexionPDO();
        $data = [
            ':libgalop' => $libgalop,
            ':id' => $id
        ];

        $sql = "UPDATE galop SET libgalop = :libgalop WHERE idgalop = :id;";
        $stmt = $con->prepare($sql);
    
        return $stmt->execute($data);
    }

    // Method to soft delete a galop
    public function Supprimer($id) {
        $con = connexionPDO();
        $data = [':id' => $id];
    
        $sql = "UPDATE galop SET supprime = 1 WHERE idgalop = :id;";
        $stmt = $con->prepare($sql);
    
        return $stmt->execute($data);
    }
}
?>
