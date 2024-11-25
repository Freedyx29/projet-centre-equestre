<?php

include '../include/bdd.inc.php';

class Cours {

    private $idcours;
    private $libcours;
    private $hdebut;
    private $hfin;
    private $jour;

    public function __construct($idco = null, $libc = null, $hd = null, $hf = null, $j = null) {
        $this->idcours = $idco;
        $this->libcours = $libc;
        $this->hdebut = $hd;
        $this->hfin = $hf;
        $this->jour = $j;
    }


    public function getCours() {
        return "ID cours : $this->idcours,
                Lib courq : $this->libcours,
                Heure début : $this->hdebut,
                Heure Fin : $this->hfin,
                Jour : $this->jour";
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

    public function getjour() {
        return $this->jour;
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

    public function setjour($j) {
        $this->jour = $j;
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
    public function Modifier($id, $libc, $hd, $hf, $j){
        $con = connexionPDO();
        $data = [
            ':libc' => $libc,
            ':hd' => $hd,
            ':hf' => $hf,
            ':j' => $j,
            ':id' => $id
        ];
    
        $sql = "UPDATE cours 
                SET libcours = :libc, hdebut =:hd, hfin = :hf, jour =:j
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
    public function Supprimer($id) {
        try {
            $con = connexionPDO();
            $data = [':id' => $id];

            $sql = "UPDATE cours SET supprime = 1 WHERE idcours = :id;";
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
    public function CoursAjt($libcours, $hdebut, $hfin, $jour){
        $con = connexionPDO();
        $data = [
            ':libcours' => $libcours,
            ':hdebut' => $hdebut,
            ':hfin' => $hfin,
            ':jour' => $jour,
        ];
    
        $sql = "INSERT INTO cours (libcours, hdebut, hfin, jour) VALUES (:libcours, :hdebut, :hfin, :jour);";
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
