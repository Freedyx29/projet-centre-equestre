<?php 

include_once '../include/bdd.inc.php'; // Ensure the path is correct for your project

class Robe {
    private $idrobe;
    private $librobe;

    public function __construct($idrobe = null, $librobe = null) {
        $this->idrobe = $idrobe;
        $this->librobe = $librobe;
    }

    // Getters
    public function getidrobe() {
        return $this->idrobe;
    }

    public function getlibrobe() {
        return $this->librobe;
    }

    // Setters
    public function setlibrobe($librobe) {
        $this->librobe = $librobe;
    }

    // Method to retrieve all robes
    public function RobeALL() {
        $con = connexionPDO(); // Assuming this function returns a PDO connection
        $sql = "SELECT * FROM robe WHERE supprime = 0;"; // Fetch only non-deleted records
        $stmt = $con->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch results as an associative array
    }

    // Method to add a new robe
    public function robeAjout($librobe) {
        $con = connexionPDO();
        $sql = "INSERT INTO robe (librobe) VALUES (:librobe);";
        $stmt = $con->prepare($sql);
        $data = [':librobe' => $librobe];
        
        if ($stmt->execute($data)) {
            return $con->lastInsertId(); // Return the ID of the newly inserted robe
        } else {
            return false; // Return false on failure
        }
    }

    // Method to update an existing robe
    public function Modifier($id, $librobe) {
        $con = connexionPDO();
        $data = [
            ':librobe' => $librobe,
            ':id' => $id
        ];

        $sql = "UPDATE robe SET librobe = :librobe WHERE idrobe = :id;";
        $stmt = $con->prepare($sql);
    
        return $stmt->execute($data); // Returns true on success, false on failure
    }

    // Method to soft delete a robe
    public function Supprimer($id) {
        $con = connexionPDO();
        $data = [':id' => $id];
    
        $sql = "UPDATE robe SET supprime = 1 WHERE idrobe = :id;";
        $stmt = $con->prepare($sql);
    
        return $stmt->execute($data); // Returns true on success, false on failure
    }

    // Method to select types for FK (if applicable)
    public function selectTypeFK() {
        $con = connexionPDO();
        $sql = "SELECT * FROM fk;"; // Adjust table name if necessary
        $stmt = $con->query($sql);                   
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch results as an associative array
    }
}

?>
