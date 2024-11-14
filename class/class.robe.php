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
        $con = connexionPDO();
        $sql = "SELECT * FROM robe;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
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
                WHERE idrobe = :id";
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
        $con = connexionPDO();
        $data = [
            ':id' => $id
        ];
    
        $sql = "UPDATE robe SET supprime = 1 WHERE idrobe = :id;";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Suppression réussie";
            return true;
        } else {
            $errorInfo = $stmn->errorInfo();
            echo "Erreur lors de la suppression : " . $errorInfo[2];
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