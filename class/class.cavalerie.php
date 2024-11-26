<?php
include_once '../include/bdd.inc.php';
class Cavalerie {
    private $numsire;
    private $nomche;
    private $datenache;
    private $garrot;
    private $photo;
    private $idrace;
    private $idrobe;

    public function __construct($nums = null, $nomc = null, $daten = null, $gar = null, $photo = null, $idra = null, $idro = null) {
        $this->numsire = $nums;
        $this->nomche = $nomc;
        $this->datenache = $daten;
        $this->garrot = $gar;
        $this->photo = $photo;
        $this->idrace = $idra;
        $this->idrobe = $idro;
    }

    public function getCavalerie() {
        return "numsire: $this->numsire,
                nomche: $this->nomche,
                datenache: $this->datenache,
                garrot: $this->garrot,
                photo: $this->photo,
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

    public function getphoto() {
        return $this->photo;
    }

    public function getidrace() {
        return $this->idrace;
    }

    public function getidrobe() {
        return $this->idrobe;
    }


    public function setnomche($nomc) {
        $this->nomche = $nomc;
    }

    public function setdatenache($daten) {
        $this->datenache = $daten;
    }

    public function setgarrot($gar) {
        $this->garrot = $gar;
    }

    public function setphoto($photo) {
        $this->photo = $photo;
    }

    public function setidrace($idra) {
        $this->idrace = $idra;
    }

    public function setidrobe($idro) {
        $this->idrobe = $idro;
    }

    public function CavalerieAll(){
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


    public function Modifier($id, $nomc, $daten, $gar, $photo, $idra, $idro) {
        $con = connexionPDO();
        $data = [
            ':nomche' => $nomc,
            ':datenache' => $daten,
            ':garrot' => $gar,
            ':photo' => $photo,
            ':idrace' => $idra,
            ':idrobe' => $idro,
            ':id' => $id
        ];

        $sql = "UPDATE cavalerie
                SET nomche = :nomche, datenache = :datenache, garrot = :garrot, photo = :photo, idrace = :idrace, idrobe = :idrobe
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


    public function Supprimer($id) {
        try {
            $con = connexionPDO();
            $data = [':id' => $id];

            $sql = "UPDATE cavalerie
                    SET supprime = 1
                    WHERE numsire = :id;";
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


    public function CavalerieAjt($nomc, $daten, $gar, $photo, $idra, $idro) {
        $con = connexionPDO();
        $data = [
            ':nomche' => $nomc,
            ':datenache' => $daten,
            ':garrot' => $gar,
            ':photo' => $photo,
            ':idrace' => $idra,
            ':idrobe' => $idro
        ];

        $sql = "INSERT INTO cavalerie (nomche, datenache, garrot, photo, idrace, idrobe)
                VALUES (:nomche, :datenache, :garrot, :photo, :idrace, :idrobe);";
        $stmn = $con->prepare($sql);

        if ($stmn->execute($data)) {
            echo "Cavalerie ajoutée";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }


    public function selectRace() {
        $con = connexionPDO();
        $sql = "SELECT * FROM race;";
        $executesql = $con->query($sql);
        return $executesql;
    }

    public function selectRobe() {
        $con = connexionPDO();
        $sql = "SELECT * FROM robe;";
        $executesql = $con->query($sql);
        return $executesql;
    }

}
?>
