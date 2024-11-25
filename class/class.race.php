<?php

include '../include/bdd.inc.php';

class Race {
    private $idrace;
    private $librace;

    public function __construct($idra = null, $libra = null) {
        $this->idrace = $idra;
        $this->librace = $libra;
    }

    public function getRace() {
        return "ID Race : $this->idrace,
                Lib race : $this->librace";
    }

    public function getidrace() {
        return $this->idrace;
    }

    public function getlibrace() {
        return $this->librace;
    }

    public function setlibrace($libra) {
        $this->librace = $libra;
    }

    //Requêtes

    //Modèle SELECT : lire
    public function RaceALL() {
        try {
            $con = connexionPDO();
            $sql = "SELECT * FROM race WHERE supprime = 0 OR supprime IS NULL ORDER BY idrace DESC;";
            $executesql = $con->prepare($sql);
            $executesql->execute();
            $resultat = $executesql->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e) {
            error_log("Erreur dans RaceAll: " . $e->getMessage());
            return [];
        }   
    }

    //Modèle UPDATE : modifier
    public function Modifier($id, $libra) {
        $con = connexionPDO();
        $data = [
            ':libra' => $libra,
            ':id' => $id
        ];
    
        $sql = "UPDATE race 
                SET librace = :libra
                WHERE idrace = :id;";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Race modifiée";
            return true;
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }

    //Modèle DELETE : supprimer
    public function Supprimer($id) {
        try {
            $con = connexionPDO();
            $data = [':id' => $id];

            $sql = "UPDATE race SET supprime = 1 WHERE idrace = :id;";
            $stmn = $con->prepare($sql);

            $result = $stmn->execute($data);

            if ($result) {
                if ($stmn->rowCount() > 0) {
                    return true;
                } else {
                    error_log("Aucune ligne n'a été modifiée pour l'ID: " . $id);
                    return false;
                }
            } else {
                $errorInfo = $stmn->errorInfo();
                error_log("Erreur SQL: " . $errorInfo[2]);
                return false;
            }
        } catch (PDOException $e) {
            error_log("Exception PDO: " . $e->getMessage());
            return false;
        }
    }

    //Modèle INSERT : créer
    public function RaceAjt($librace) {
        $con = connexionPDO();
        $data = [
            ':librace' => $librace,
        ];
    
        $sql = "INSERT INTO race (librace) VALUES (:librace);";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Race insérée";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }
}
?>
