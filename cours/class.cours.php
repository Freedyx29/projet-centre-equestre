<?php
require_once '../include/bdd.inc.php';

class Cours {
    private $idcours;
    private $libcours;
    private $hdebut;
    private $hfin;

    function __construct($idc = null, $libc = null, $hdeb = null, $hfin = null) {
        $this->idcours = $idc;
        $this->libcours = $libc;
        $this->hdebut = $hdeb;
        $this->hfin = $hfin;
    }

    public function getCours() {
        return "idcours : $this->idcours,
                libcours : $this->libcours,
                hdebut : $this->hdebut,
                hfin : $this->hfin";
    }

    public function getIdcours() {
        return $this->idcours;
    }

    public function getLibcours() {
        return $this->libcours;
    }

    public function getHdebut() {
        return $this->hdebut;
    }

    public function getHfin() {
        return $this->hfin;
    }

    public function setLibcours($libc) {
        $this->libcours = $libc;
    }

    public function setHdebut($hdeb) {
        $this->hdebut = $hdeb;
    }

    public function setHfin($hfin) {
        $this->hfin = $hfin;
    }

    // Requêtes

    // Modèle SELECT : lire
    public function read() {
        $con = connexionPDO();
        $sql = "SELECT * FROM cours;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }

    // Modèle UPDATE : modifier
    public function update($id, $libcours, $hdebut, $hfin) {
        $con = connexionPDO();
        $data = [
            ':libcours' => $libcours,
            ':hdebut' => $hdebut,
            ':hfin' => $hfin,
            ':id' => $id
        ];

        $sql = "UPDATE cours
                SET libcours = :libcours, hdebut = :hdebut, hfin = :hfin
                WHERE idcours = :id;";
        $stmm = $con->prepare($sql);

        if ($stmm->execute($data)) {
            echo "Cours modifié";
            return true;
        } else {
            echo $stmm->errorInfo();
            return false;
        }
    }

    // Modèle DELETE : supprimer
    public function delete($id) {
        $con = connexionPDO();
        $data = [
            ':id' => $id
        ];

        $sql = "DELETE FROM cours WHERE idcours = :id;";
        $stmm = $con->prepare($sql);

        if ($stmm->execute($data)) {
            echo "Suppression réussie";
            return true;
        } else {
            $errorInfo = $stmm->errorInfo();
            echo "Erreur lors de la suppression : " . $errorInfo[2];
            return false;
        }
    }

    // Modèle INSERT : créer
    public function create($libcours, $hdebut, $hfin) {
        $con = connexionPDO();
        $data = [
            ':libcours' => $libcours,
            ':hdebut' => $hdebut,
            ':hfin' => $hfin
        ];

        $sql = "INSERT INTO cours (libcours, hdebut, hfin) VALUES (:libcours, :hdebut, :hfin);";
        $stmm = $con->prepare($sql);

        if ($stmm->execute($data)) {
            echo "Cours inséré";
            return $con->lastInsertId();
        } else {
            echo $stmm->errorInfo();
            return false;
        }
    }
}
?>
