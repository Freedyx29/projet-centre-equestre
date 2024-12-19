<?php
include_once '../include/bdd.inc.php';

class Pension {
    private $idpen;
    private $libpen;
    private $dateD;
    private $dateF;
    private $tarif;
    private $numsire;

    public function __construct($idp = null, $libp = null, $datD = null, $datF = null, $tarif = null, $nums = null) {
        $this->idpen = $idp;
        $this->libpen = $libp;
        $this->dateD = $datD;
        $this->dateF = $datF;
        $this->tarif = $tarif;
        $this->numsire = $nums;
    }

    public function getNomCavalier($idcava) {
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
            $sql = "SELECT
                        p.*,
                        GROUP_CONCAT(DISTINCT c.nomcava ORDER BY c.nomcava SEPARATOR ', ') AS noms_cavaliers
                    FROM
                        pension p
                    LEFT JOIN
                        prend pr ON p.idpen = pr.redifpen
                    LEFT JOIN
                        cavaliers c ON pr.refidcava = c.idcava
                    WHERE
                        p.supprime = 0 OR p.supprime IS NULL
                    GROUP BY
                        p.idpen
                    ORDER BY
                        p.idpen DESC;";
            $executesql = $con->prepare($sql);
            $executesql->execute();
            $resultat = $executesql->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e) {
            error_log("Erreur dans PensionALL: " . $e->getMessage());
            return [];
        }
    }

    public function getCavaliersForPension($idpen) {
        try {
            $con = connexionPDO();
            $sql = "SELECT c.*
                    FROM cavaliers c
                    JOIN prend p ON c.idcava = p.refidcava
                    WHERE p.redifpen = :idpen
                    AND (p.supprime = 0 OR p.supprime IS NULL)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':idpen', $idpen, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur dans getCavaliersForPension: " . $e->getMessage());
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

    public function Modifier($id, $libp, $datD, $datF, $tarif, $nums) {
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
            error_log("Requête SQL exécutée avec succès : $sql");
            return true;
        } else {
            $errorInfo = $stmn->errorInfo();
            error_log("Erreur SQL dans Modifier: " . $errorInfo[2]);
            return false;
        }
    }

   public function updateCavaliers($idpen, $idcava1, $idcava2) {
    $con = connexionPDO();
    $data = [
        ':idpen' => $idpen,
        ':idcava1' => $idcava1,
        ':idcava2' => $idcava2
    ];

    // Supprimer les anciens cavaliers associés à cette pension
    $sqlDelete = "DELETE FROM prend WHERE redifpen = :idpen;";
    $stmnDelete = $con->prepare($sqlDelete);
    $stmnDelete->execute([':idpen' => $idpen]);

    // Ajouter les nouveaux cavaliers
    if ($idcava1) {
        $sqlInsert1 = "INSERT INTO prend (refidcava, redifpen) VALUES (:idcava1, :idpen);";
        $stmnInsert1 = $con->prepare($sqlInsert1);
        $stmnInsert1->execute([':idcava1' => $idcava1, ':idpen' => $idpen]);
        error_log("Cavalier 1 ajouté : $sqlInsert1");
    }

    if ($idcava2) {
        $sqlInsert2 = "INSERT INTO prend (refidcava, redifpen) VALUES (:idcava2, :idpen);";
        $stmnInsert2 = $con->prepare($sqlInsert2);
        $stmnInsert2->execute([':idcava2' => $idcava2, ':idpen' => $idpen]);
        error_log("Cavalier 2 ajouté : $sqlInsert2");
    }

    error_log("Cavaliers mis à jour pour la pension ID: $idpen avec IDs cavaliers: $idcava1, $idcava2");
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
            return $con->lastInsertId();
        } else {
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
