<?php

include_once '../include/bdd.inc.php';

class Prend {

    private $refidcava;
    private $refidpen;

    function __construct(string $ridc = null, string $ridp = null) {
        $this->refidcava = $ridc;
        $this->refidpen = $ridp;
    }

    public function getPrend() {
        return "Ref idcava : $this->refidcava,
                Ref idpen : $this->refidpen";
    }


    public function getrefidcava() {
        return $this->refidcava;
    }

    public function getrefidpen() {
        return $this->refidpen;
    }


    public function setrefidcava($ridc) {
        $this->refidpen = $ridc;
    }

    public function setrefidpen($ridp) {
        $this->refidpen = $ridp;
    }


    //lire Prend
    public function PrendAll() {
        $con = connexionPDO();
        $sql = "SELECT *
                FROM prend";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }


    public function PrendCava($id) {
        $con = connexionPDO();
        $sql = "SELECT nomcava
                FROM cavaliers
                WHERE idcava = :idcava";
        $data = [':idcava' => $id];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $ligne = $executesql->fetch();
        return $ligne['nomcava'];
    }

    public function PrendPen($id) {
        $con = connexionPDO();
        $sql = "SELECT libpen
                FROM pension
                WHERE idpen = :idpen";
        $data = [':idpen' => $id];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $ligne = $executesql->fetch();
        return $ligne['libpen'];
    }


    //Update Prend
    public function Modifier($id_cava_first, $id_pen_first, $refidcava, $refidpen) {
        $con = connexionPDO();
        $data = [
            ':refidcava' => $refidcava,
            ':refidpen' => $refidpen,
            ':id_cava_first' => $id_cava_first,
            ':id_pen_first' => $id_pen_first
        ];

        $sql = "UPDATE prend 
                SET refidcava = :refidcava, refidpen = :refidpen
                WHERE refidcava = :id_cava_first AND refidpen = :id_pen_first;";
        $stmt = $con->prepare($sql);
 
        if ($stmt->execute($data)) {
            echo "Prend modifiée";
            return true;
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }


    public function Supprimer($refidcava, $refidpen){
        try {
            $con = connexionPDO();
            $data = [
            ':refidcava' => $refidcava,
            ':refidpen' => $refidpen
        ];
    
        $sql = "UPDATE prend SET supprime = 1 WHERE refidcava = :refidcava AND refidpen = :refidpen;";
        $stmt = $con->prepare($sql);
    
        if ($stmt->execute($data)) {
            echo "Suppression réussie";
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Erreur lors de la suppression : " . $errorInfo[2];
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        }
    }    

    public function PrendAjt($refidcava, $refidpen) {
        $con = connexionPDO();
        $data = [
            ':refidcava' => $refidcava,
            ':refidpen' => $refidpen
        ];

        $sql = "INSERT INTO prend (refidcava, refidpen) 
                SELECT :refidcava, :refidpen
                WHERE (SELECT COUNT(*) FROM prend WHERE refidcava = :refidcava AND refidpen = :refidpen) = 0";
        $stmt = $con->prepare($sql);
        
        if ($stmt->execute($data)) {
            echo "Prend insérée";
            return $con->lastInsertId();
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }


    public function selectTypeCava(){
        $con = connexionPDO();
        $sql="SELECT * FROM idcava;";
        $executesql = $con->query($sql);                   
        return $executesql;
    }
    
    public function selectTypePen(){
        $con = connexionPDO();
        $sql="SELECT * FROM idpen;";
        $executesql = $con->query($sql);                   
        return $executesql;
    }
}

?>
