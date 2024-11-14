<?php

include_once '../include/bdd.inc.php';

class Inscrit {

    private $refidcours;
    private $refidcava;

    function __construct(string $ridco = null, string $ridca = null) {
        $this->refidcours = $ridco;
        $this->refidcava = $ridca;
    }

    public function getPrend() {
        return "Ref idcours : $this->refidcours,
                Ref idcava : $this->refidcava";
    }


    public function getrefidcours() {
        return $this->refidcours;
    }

    public function getrefidcava() {
        return $this->refidcava;
    }


    public function setrefidcours($ridco) {
        $this->refidcours = $ridco;
    }

    public function setrefidcava($ridca) {
        $this->refidcava = $ridca;
    }


    public function InscritALL() {
        $con = connexionPDO();
        $sql = "SELECT *
                FROM inscrit";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }

    public function InscritCours($id) {
        $con = connexionPDO();
        $sql = "SELECT libcours
                FROM cours
                WHERE idcours = :idcours";
        $data = [':idcours' => $id];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $ligne = $executesql->fetch();
        return $ligne['libcours'];
    }

    public function InscritCava($id) {
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


    public function Modifier($id_cours_first, $id_cava_first, $refidcours, $refidcava) {
        $con = connexionPDO();
        $data = [
            ':refidcours' => $refidcours,
            ':refidcava' => $refidcava,
            ':id_cours_first' => $id_cours_first,
            ':id_cava_first' => $id_cava_first
        ];

        $sql = "UPDATE inscrit 
                SET refidcours = :refidcours, refidcava = :refidcava 
                WHERE refidcours = :id_cours_first AND refidcava = :id_cava_first; AND (refidcours, refidcava) NOT IN (SELECT refidcours, refidcava FROM inscrit)";
        $stmt = $con->prepare($sql);
 
        if ($stmt->execute($data)) {
            echo "Inscrit modifiée";
            return true;
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }


    public function Supprimer($refidcours, $refidcava){
        $con = connexionPDO();
        $data = [
            ':refidcours' => $refidcours,
            ':refidcava' => $refidcava
        ];
    
        $sql = "UPDATE inscrit SET supprime = 1 WHERE refidcours = :refidcours AND refidcava = :refidcava;";
        $stmt = $con->prepare($sql);
    
        if ($stmt->execute($data)) {
            echo "Suppression réussie";
            return true;
        } else {
            $errorInfo = $stmt->errorInfo();
            echo "Erreur lors de la suppression : " . $errorInfo[2];
            return false;
        }
    }


    public function InscritAjt($refidcours, $refidcava) {
        $con = connexionPDO();
        $data = [
            ':refidcours' => $refidcours,
            ':refidcava' => $refidcava
        ];

        $sql = "INSERT INTO inscrit (refidcours, refidcava) 
                SELECT :refidcours, :refidcava
                WHERE (SELECT COUNT(*) FROM inscrit WHERE refidcours = :refidcours AND refidcava = :refidcava) = 0";
        $stmt = $con->prepare($sql);
        
        if ($stmt->execute($data)) {
            echo "Prend insérée";
            return $con->lastInsertId();
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }


    public function selectTypeCours(){
        $con = connexionPDO();
        $sql="SELECT * FROM idcours;";
        $executesql = $con->query($sql);                   
        return $executesql;
    }

    public function selectTypeCava(){
        $con = connexionPDO();
        $sql="SELECT * FROM idcava;";
        $executesql = $con->query($sql);                   
        return $executesql;
    }
}

?>
