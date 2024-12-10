<?php
include_once '../include/bdd.inc.php';
class Pension {
     public function __construct($idp = null, $libp = null, $datD = null, $datF = null, $tarif = null, $nums = null) {
        $this->idpen = $idp;
        $this->libpen = $libp;
        $this->dateD = $datD;
        $this->dateF = $datF;
        $this->tarif = $tarif;
        $this->numsire = $nums;
    }

    public function getNomCavalier($idcava) {
        // Récupérer le nom du cavalier en fonction de son ID
        $con = connexionPDO();
        $sql = "SELECT nomcava FROM cavaliers WHERE idcava = :idcava";
        $req = $con->prepare($sql);
        $req->bindParam(':idcava', $idcava, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['nomcava'] : '';
    }


 

    public function getPension() {
        return "idpen: $this->idpen,
                libpen: $this->libpen,
                dateD: $this->dateD,
                dateF: $this->dateF,
                tarif: $this->tarif,
                numsire: $this->numsire";
    }

    public function getidpen() {
        return $this->idpen;
    }
    
    public function getlibpen() {
        return $this->libpen;
    }

    public function getdateD() {
        return $this->dateD;
    }

    public function getdateF() {
        return $this->dateF;
    }
    
    public function gettarif() {
        return $this->tarif;
    }
    
    public function getnumsire() {
        return $this->numsire;
    }

    
    public function setlibpen($libp) {
        $this->libpen = $libp;
    }

    public function setdateD($datD) {
        $this->dateD = $datD;
    }

    public function setdateF($datF) {
        $this->dateF = $datF;
    }
    
    public function settarif($tarif) {
        $this->tarif = $tarif;
    }
    
    public function setnumsire($nums) {
        $this->numsire = $nums;
    }
    
public function selectNomCava(){
    $con = connexionPDO();
    $sql = "SELECT * FROM cavaliers;";
    $executesql = $con->query($sql);
    return $executesql;
}

    public function PensionALL() {
        try {
            $con = connexionPDO();
            $sql = "SELECT p.*, pr.refidcava as idcava 
                    FROM pension p 
                    LEFT JOIN prend pr ON p.idpen = pr.refidpen 
                    WHERE p.supprime = 0 OR p.supprime IS NULL 
                    ORDER BY p.idpen DESC;";
            $executesql = $con->prepare($sql);
            $executesql->execute();
            $resultat = $executesql->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e) {
            error_log("Erreur dans PensionALL: " . $e->getMessage());
            return [];
        }
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


    public function Modifier($id, $libp, $datD, $datF, $tarif, $nums){
        $con = connexionPDO();
        $data = [
            ':libp' => $libp,
            ':datD' => $datD,
            ':datF' => $datF,
            ':tarif' => $tarif,
            ':nums' => $nums,
            ':id' => $id
        ];
    
        $sql = "UPDATE pension 
                SET libpen = :libp, dateD = :datD, dateF = :datF, tarif = :tarif, numsire = :nums
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
        try {
            $con = connexionPDO();
            $data = [':id' => $id];
        
            $sql = "UPDATE pension SET supprime = 1 WHERE idpen = :id;";
            $stmn = $con->prepare($sql);
        
            $result = $stmn->execute($data);
            
            if ($result) {
                // Vérifions si une ligne a été affectée
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


    public function PensionAjt($libpen, $datD, $datF, $tarif, $numsire){
        $con = connexionPDO();
        $data = [
            ':libpen' => $libpen,
            ':datD' => $datD,
            ':datF' => $datF,
            ':tarif' => $tarif,
            ':numsire' => $numsire
        ];
                                
        $sql = "INSERT INTO pension (libpen, dateD, dateF, tarif, numsire) 
                VALUES (:libpen, :datD, :datF, :tarif, :numsire);";       
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            echo "Pension insérée";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }
    

    public function selectNomChe(){
        $con = connexionPDO();
        $sql="SELECT * FROM numsire;";
        $executesql = $con->query($sql);                   
        return $executesql;
    }
}
?>
