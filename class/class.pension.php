<?php

include_once '../include/bdd.inc.php';

class Pension {

    private $idpen;
    private $libpen;
    private $numsire;

    public function __construct($idp = null, $libp = null, $nums = null) {
        $this->idpen = $idp;
        $this->libpen = $libp;
        $this->numsire = $nums;
    }

    public function getPension() {
        return "ID Pension : $this->idpen,
                Lib Pension : $this->libpen,
                Num sire : $this->numsire";
    }

    public function getidpen() {
        return $this->idpen;
    }

    public function getlibpen() {
        return $this->libpen;
    }

    public function getnumsire() {
        return $this->numsire;
    }


    public function setlibpen($libp) {
        $this->libpen = $libp;
    }

    public function setnumsire($nums) {
        $this->numsire = $nums;
    }


    public function PensionALL() {
        $con = connexionPDO();
        $sql = "SELECT *
                FROM pension";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }

    public function PensionNumsire($id) {
        $con = connexionPDO();
        $sql = "SELECT nomche
                FROM cavalerie
                WHERE numsire = :numsire";
        $data = [':numsire' => $id];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $ligne = $executesql->fetch();
        return $ligne['nomche'];
    }


    public function Modifier($id, $libp, $nums){
        $con = connexionPDO();
        $data = [
            ':libp' => $libp,
            ':nums' => $nums,
            ':id' => $id
        ];
    
        $sql = "UPDATE pension 
                SET libpen = :libp, numsire = :nums
                WHERE idpen = :id;";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Pension modifiée";
            return true;
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }


    public function Supprimer($id){
        $con = connexionPDO();
        $data = [
            ':id' => $id
        ];
    
        $sql = "UPDATE pension SET supprime = 1 WHERE idpen = :id;";
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


    public function PensionAjt($libpen, $numsire){
        $con = connexionPDO();
        $data = [
            ':libpen' => $libpen,
            ':numsire' => $numsire
        ];
                                
        $sql = "INSERT INTO pension (libpen, numsire) 
                VALUES (:libpen, :numsire);";       
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Pension insérée";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }
    
    public function selectTypeChe(){
        $con = connexionPDO();
        $sql="SELECT * FROM numsire;";
        $executesql = $con->query($sql);                   
        return $executesql;
    }
}

?>
