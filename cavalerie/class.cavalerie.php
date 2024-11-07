<?php

include_once '../include/bdd.inc.php';

class Cavalerie {

    private $numsire;
    private $nomche;
    private $datenache;
    private $garrot;
    private $idrace;
    private $idrobe;

    public function __construct($nums = null, $nche = null, $dnche = null, $ga = null, $idra = null, $idro = null) {
        $this->numsire = $nums;
        $this->nomche = $nche;
        $this->datenache = $dnche;
        $this->garrot = $ga;
        $this->idrace = $idra;
        $this->idrobe = $idro;
    }


    public function getCavelerie() {
        return "numsire: $this->numsire,
                nomche: $this->nomche,
                datenache: $this->datenache,
                garrot: $this->garrot,
                idrace: $this->idrace,
                idrobe: $this->idrobe";
    }

    public function getnumsire() {
        return $this->numsire;
    }
    
    public function getnomche() {
        return $this->nomche;
    }
    
    public function getdatenache() {
        return $this->datenache;
    }
    
    public function getgarrot() {
        return $this->garrot;
    }
    
    public function getidrace() {
        return $this->idrace;
    }
    
    public function getidrobe() {
        return $this->idrobe;
    }
    


    public function setnomche($nche) {
        $this->nomche = $nche;
    }
    
    public function setdatenache($dnche) {
        $this->datenache = $dnche;
    }
    
    public function setgarrot($ga) {
        $this->garrot = $ga;
    }
    
    public function setidrace($idra) {
        $this->idrace = $idra;
    }
    
    public function setidrobe($idro) {
        $this->idrobe = $idro;
    }
    


    public function CavalerieALL() {
        $con = connexionPDO();
        $sql = "SELECT * FROM cavalerie;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }


    public function CavalerieRace($id) {
        $con = connexionPDO();
        $sql = "SELECT librace
                FROM race
                WHERE idrace = :idrace";
        $data = [':idrace' => $id];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $ligne = $executesql->fetch();
        return $ligne['librace'];
    }

    public function CavalerieRobe($id) {
        $con = connexionPDO();
        $sql = "SELECT librobe
                FROM robe
                WHERE idrobe = :idrobe";
        $data = [':idrobe' => $id];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $ligne = $executesql->fetch();
        return $ligne['librobe'];
    }



    public function Modifier($id, $nche, $dnche, $ga, $idra, $idro){
        $con = connexionPDO();
        $data = [
            ':nche' => $nche,
            ':dnche' => $dnche,
            ':ga' => $ga,
            ':idra' => $idra,
            ':idro' => $idro,
            ':id' => $id
        ];
    
        $sql = "UPDATE cavalerie 
                SET nomche = :nche, datenache = :dnche, garrot = :ga, idrace = :idra, idrobe = :idro
                WHERE numsire = :id;";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Cavalerie modifiée";
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
    
        $sql = "UPDATE cavalerie SET supprime = 1 WHERE numsire = :id;";
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


    public function CavalerieAjt($nomche, $datenache, $garrot, $idrace, $idrobe){
        $con = connexionPDO();
        $data = [
            ':nomche' => $nomche,
            ':datenache' => $datenache,
            ':garrot' => $garrot,
            ':idrace' => $idrace,
            ':idrobe' => $idrobe
        ];
                                
        $sql = "INSERT INTO cavalerie (nomche, datenache, garrot, idrace, idrobe) 
                VALUES (:nomche, :datenache, :garrot, :idrace, :idrobe);";       
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Cavalerie insérée";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }
    
    public function selectTypeRace(){
        $con = connexionPDO();
        $sql="SELECT * FROM idrace;";
        $executesql = $con->query($sql);                   
        return $executesql;
    }

    public function selectTypeRobe(){
        $con = connexionPDO();
        $sql="SELECT * FROM idrobe;";
        $executesql = $con->query($sql);                   
        return $executesql;
    }
}

?>