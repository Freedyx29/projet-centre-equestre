<?php

include_once '../include/bdd.inc.php';

include_once 'class.cours.php';

class Inscrit {

    private $refidcours;
    private $refidcava;

    function __construct(string $ridco = null, string $ridca = null) {
        $this->refidcours = $ridco;
        $this->refidcava = $ridca;
    }

    public function getInscrit() {
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
        
        // Vérifiez si la nouvelle combinaison existe déjà
        $checkSql = "SELECT COUNT(*) FROM inscrit WHERE refidcours = :refidcours AND refidcava = :refidcava";
        $checkStmt = $con->prepare($checkSql);
        $checkStmt->execute([':refidcours' => $refidcours, ':refidcava' => $refidcava]);

        if ($checkStmt->fetchColumn() > 0) {
            echo "Cette inscription existe déjà.";
            return false;
        }

        $data = [
            ':refidcours' => $refidcours,
            ':refidcava' => $refidcava,
            ':id_cours_first' => $id_cours_first,
            ':id_cava_first' => $id_cava_first
        ];

        $sql = "UPDATE inscrit 
                SET refidcours = :refidcours, refidcava = :refidcava 
                WHERE refidcours = :id_cours_first AND refidcava = :id_cava_first";
        $stmt = $con->prepare($sql);

        if ($stmt->execute($data)) {
            // Récupérer le jour du cours
            $sqlJour = "SELECT jour FROM cours WHERE idcours = :idcours";
            $stmtJour = $con->prepare($sqlJour);
            $stmtJour->execute([':idcours' => $refidcours]);
            $jour = $stmtJour->fetchColumn();

            // Mettre à jour les participations
            $cours = new Cours();
            $seances = $cours->ajouterOccurrencesCalendrier($refidcours, $jour);
            $cours->ajouterParticipations($refidcours, $seances, [$refidcava]);

            return true;
        } else {
            echo $stmt->errorInfo();
            return false;
        }
    }


    public function Supprimer($refidcours, $refidcava){
        try {
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
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
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
            // Récupérer le jour du cours
            $sqlJour = "SELECT jour FROM cours WHERE idcours = :idcours";
            $stmtJour = $con->prepare($sqlJour);
            $stmtJour->execute([':idcours' => $refidcours]);
            $jour = $stmtJour->fetchColumn();

            // Ajouter les participations après l'inscription
            $cours = new Cours();
            $seances = $cours->ajouterOccurrencesCalendrier($refidcours, $jour);
            $cours->ajouterParticipations($refidcours, $seances, [$refidcava]);
            
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

    public function getCavaliersForCours($idcours) {
        $con = connexionPDO();
        $sql = "SELECT cavaliers.nomcava
                FROM inscrit
                JOIN cavaliers ON inscrit.refidcava = cavaliers.idcava
                WHERE inscrit.refidcours = :idcours AND inscrit.supprime = 0";
        $data = [':idcours' => $idcours];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        return $executesql->fetchAll();
    }
}

?>
