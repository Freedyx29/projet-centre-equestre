<?php

include '../include/bdd.inc.php';

class Cours {

    private $idcours;
    private $libcours;
    private $hdebut;
    private $hfin;

    public function __construct($idco = null, $libc = null, $hd = null, $hf = null) {
        $this->idcours = $idco;
        $this->libcours = $libc;
        $this->hdebut = $hd;
        $this->hfin = $hf;
    }


    public function getCours() {
        return "ID cours : $this->idcours,
                Lib courq : $this->libcours,
                Heure début : $this->hdebut,
                Heure Fin : $this->hfin";
    }

    public function getidcours() {
        return $this->idcours;
    }

    public function getlibcours() {
        return $this->libcours;
    }

    public function gethdebut() {
        return $this->hdebut;
    }

    public function gethfin() {
        return $this->hfin;
    }


    public function setlibcours($libc) {
        $this->libcours = $libc;
    }

    public function sethdebut($hd) {
        $this->hdebut = $hd;
    }

    public function sethfin($hf) {
        $this->hfin = $hf;
    }


        //Requêtes

    //Modèle SELECT : lire
    public function CoursAll(){
        $con = connexionPDO();
        $sql = "SELECT * FROM cours;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }
    

    //Modèle UPDATE : modifier
    public function Modifier($id, $libc, $hd, $hf){
        $con = connexionPDO();
        $data = [
            ':libc' => $libc,
            ':hd' => $hd,
            ':hf' => $hf,
            ':id' => $id
        ];
    
        $sql = "UPDATE cours 
                SET libcours = :libc, hdebut =:hd, hfin = :hf
                WHERE idcours = :id";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Cours modifiée";
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
    
        $sql = "UPDATE cours SET supprime = 1 WHERE idcours = :id;";
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
    public function CoursAjt($libcours, $hdebut, $hfin){
        $con = connexionPDO();
        $data = [
            ':libcours' => $libcours,
            ':hdebut' => $hdebut,
            ':hfin' => $hfin,
        ];
    
        $sql = "INSERT INTO cours (libcours, hdebut, hfin) VALUES (:libcours, :hdebut, :hfin);";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Cours insérée";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }
}

?>