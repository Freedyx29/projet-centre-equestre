<?php

include '../include/bdd.inc.php';

class Robe {

    private $idrobe;
    private $librobe;

    public function __construct($idro = null, $libro = null) {
        $this->idrobe = $idro;
        $this->librobe = $libro;
    }


    public function getRobe() {
        return "ID Robe : $this->idrobe,
                Lib robe : $this->librobe";
    }

    public function getidrobe() {
        return $this->idrobe;
    }

    public function getlibrobe() {
        return $this->librobe;
    }


    public function setlibrobe($libro) {
        $this->librobe = $libro;
    }


        //Requêtes

    //Modèle SELECT : lire
    public function RobeALL(){
        try {
            $con = connexionPDO();
            $sql = "SELECT * FROM robe WHERE supprime = 0 OR supprime IS NULL ORDER BY idrobe DESC;";
            $executesql = $con->prepare($sql);
            $executesql->execute();
            $resultat = $executesql->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e) {
            error_log("Erreur dans RobeAll: " . $e->getMessage());
            return [];
        }   
    }
    

    //Modèle UPDATE : modifier
    public function Modifier($id, $libro){
        $con = connexionPDO();
        $data = [
            ':libro' => $libro,
            ':id' => $id
        ];
    
        $sql = "UPDATE robe 
                SET librobe = :libro
                WHERE idrobe = :id;";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Robe modifiée";
            return true;
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }


    //Modèle DELETE : supprimer
    public function Supprimer($id){
        try {
            $con = connexionPDO();
            $data = [':id' => $id];

            $sql = "UPDATE robe SET supprime = 1 WHERE idrobe = :id;";
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
    public function RobeAjt($librobe){
        $con = connexionPDO();
        $data = [
            ':librobe' => $librobe,
        ];
    
        $sql = "INSERT INTO robe (librobe) VALUES (:librobe);";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Robe insérée";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }
}

?>
