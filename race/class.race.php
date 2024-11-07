<?php 

include_once '../include/bdd.inc.php'; // Assurez-vous que le chemin est correct pour votre projet

class Race {
    private $idrace;
    private $librace;

    public function __construct($idrace = null, $librace = null) {
        $this->idrace = $idrace;
        $this->librace = $librace;
    }

    // Getters
    public function getidrace() {
        return $this->idrace;
    }

    public function getlibrace() {
        return $this->librace;
    }

    // Setters
    public function setlibrace($librace) {
        $this->librace = $librace;
    }

    // Method to retrieve all races
    public function RaceALL() {
        $con = connexionPDO();
        $sql = "SELECT * FROM race WHERE supprime = 0;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to add a new race
    public function raceAjout($librace) {
        $con = connexionPDO();
        $sql = "INSERT INTO race (librace) VALUES (:librace);";
        $stmt = $con->prepare($sql);
        $data = [':librace' => $librace];
        
        if ($stmt->execute($data)) {
            return $con->lastInsertId();
        } else {
            return false;
        }
    }

    // Method to update an existing race
    public function Modifier($id, $librace) {
        $con = connexionPDO();
        $data = [
            ':librace' => $librace,
            ':id' => $id
        ];

        $sql = "UPDATE race SET librace = :librace WHERE idrace = :id;";
        $stmt = $con->prepare($sql);
    
        return $stmt->execute($data);
    }

    // Method to soft delete a race
    public function Supprimer($id) {
        $con = connexionPDO();
        $data = [':id' => $id];
    
        $sql = "UPDATE race SET supprime = 1 WHERE idrace = :id;";
        $stmt = $con->prepare($sql);
    
        return $stmt->execute($data);
    }
}

?>
