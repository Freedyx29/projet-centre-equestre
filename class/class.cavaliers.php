<?php
include_once '../include/bdd.inc.php';

class Cavaliers {
    private $idcava;
    private $nomcava;
    private $prenomcava;
    private $datenacava;
    private $numlic;
    private $photo;
    private $nomresp;
    private $prenomresp;
    private $rueresp;
    private $vilresp;
    private $cpresp;
    private $telresp;
    private $emailresp;
    private $password;
    private $assurance;
    private $idgalop;

    public function __construct($idca = null, $nc = null, $pc = null, $dnc = null, $nl = null, $po = null, $nr = null, $pr = null, $rr = null, $vr = null, $cpr = null, $tr = null, $emr = null, $pw = null, $assu = null, $idga = null) {
        $this->idcava = $idca;
        $this->nomcava = $nc;
        $this->prenomcava = $pc;
        $this->datenacava = $dnc;
        $this->numlic = $nl;
        $this->photo = $po;
        $this->nomresp = $nr;
        $this->prenomresp = $pr;
        $this->rueresp = $rr;
        $this->vilresp = $vr;
        $this->cpresp = $cpr;
        $this->telresp = $tr;
        $this->emailresp = $emr;
        $this->password = $pw;
        $this->assurance = $assu;
        $this->idgalop = $idga;
    }

    public function CavaliersALL() {
        $con = connexionPDO();
        $sql = "SELECT * FROM cavaliers WHERE supprime = 0;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }

    public function CavaliersGalop($id) {
        $con = connexionPDO();
        $sql = "SELECT libgalop FROM galop WHERE idgalop = :idgalop";
        $data = [':idgalop' => $id];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $ligne = $executesql->fetch();
        return $ligne['libgalop'];
    }
public function Modifier($id, $nc, $pc, $dnc, $nl, $po, $nr, $pr, $rr, $vr, $cpr, $tr, $emr, $pw, $assu, $idga){
    $con = connexionPDO();

    // Vérifiez si l'idgalop existe dans la table galop
    $sqlCheck = "SELECT COUNT(*) FROM galop WHERE idgalop = :idgalop";
    $stmtCheck = $con->prepare($sqlCheck);
    $stmtCheck->bindParam(':idgalop', $idga, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        $data = [
            ':nc' => $nc,
            ':pc' => $pc,
            ':dnc' => $dnc,
            ':nl' => $nl,
            ':po' => $po,
            ':nr' => $nr,
            ':pr' => $pr,
            ':rr' => $rr,
            ':vr' => $vr,
            ':cpr' => $cpr,
            ':tr' => $tr,
            ':emr' => $emr,
            ':pw' => $pw,
            ':assu' => $assu,
            ':idga' => $idga,
            ':id' => $id
        ];

        $sql = "UPDATE cavaliers
                SET nomcava = :nc, prenomcava = :pc, datenacava = :dnc, numlic = :nl, photo = :po, nomresp = :nr,
                    prenomresp = :pr, rueresp = :rr, vilresp = :vr, cpresp = :cpr, telresp = :tr, emailresp = :emr,
                    password = :pw, assurance = :assu, idgalop = :idga
                WHERE idcava = :id;";
        $stmn = $con->prepare($sql);

        if ($stmn->execute($data)) {
            echo "Cavalier modifié";
            return true;
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    } else {
        echo "Erreur : L'idgalop n'existe pas dans la table galop.";
        return false;
    }
}


    public function Supprimer($id){
        $con = connexionPDO();
        $data = [
            ':id' => $id
        ];

        $sql = "UPDATE cavaliers SET supprime = 1 WHERE idcava = :id;";
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

    public function CavaliersAjt($nomcava, $prenomcava, $datenacava, $numlic, $photo, $nomresp, $prenomresp, $rueresp, $vilresp, $cpresp, $telresp, $emailresp, $password, $assurance, $idgalop){
    $con = connexionPDO();

    // Vérifiez si l'idgalop existe dans la table galop
    $sqlCheck = "SELECT COUNT(*) FROM galop WHERE idgalop = :idgalop";
    $stmtCheck = $con->prepare($sqlCheck);
    $stmtCheck->bindParam(':idgalop', $idgalop, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count = $stmtCheck->fetchColumn();

    if ($count > 0) {
        $data = [
            ':nomcava' => $nomcava,
            ':prenomcava' => $prenomcava,
            ':datenacava' => $datenacava,
            ':numlic' => $numlic,
            ':photo' => $photo,
            ':nomresp' => $nomresp,
            ':prenomresp' => $prenomresp,
            ':rueresp' => $rueresp,
            ':vilresp' => $vilresp,
            ':cpresp' => $cpresp,
            ':telresp' => $telresp,
            ':emailresp' => $emailresp,
            ':password' => $password,
            ':assurance' => $assurance,
            ':idgalop' => $idgalop
        ];

        $sql = "INSERT INTO cavaliers (nomcava, prenomcava, datenacava, numlic, photo, nomresp, prenomresp,
                rueresp, vilresp, cpresp, telresp, emailresp, password, assurance, idgalop)
                VALUES (:nomcava, :prenomcava, :datenacava, :numlic, :photo, :nomresp, :prenomresp,
                :rueresp, :vilresp, :cpresp, :telresp, :emailresp, :password, :assurance, :idgalop);";
        $stmn = $con->prepare($sql);

        if ($stmn->execute($data)) {
            echo "Cavalier inséré";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    } else {
        echo "Erreur : L'idgalop n'existe pas dans la table galop.";
        return false;
    }
}


    public function selectTypeGalop(){
        $con = connexionPDO();
        $sql="SELECT * FROM galop;";
        $executesql = $con->query($sql);
        return $executesql;
    }
}
?>
