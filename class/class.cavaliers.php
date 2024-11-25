<?php

include_once '../include/bdd.inc.php';

class Cavaliers {

    private $idcava;
    private $nomcava;
    private $prenomcava;
    private $datenacava;
    private $numlic;
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

    public function __construct($idca = null, $nc = null, $pc = null, $dnc = null, $nl = null, 
                                $nr = null, $pr = null, $rr = null, $vr = null, $cpr = null, $tr = null, 
                                $emr = null, $pw = null, $assu = null, $idga = null) {
        $this->idcava = $idca;
        $this->nomcava = $nc;
        $this->prenomcava = $pc;
        $this->datenacava = $dnc;
        $this->numlic = $nl;
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


    public function getCavaliers() {
        return "idcava: $this->idcava,
                nomcava: $this->nomcava,
                prenomcava: $this->prenomcava,
                datenacava: $this->datenacava,
                numlic: $this->numlic,
                nomresp: $this->nomresp,
                prenomresp: $this->prenomresp,
                ruersp: $this->rueresp,
                vilresp: $this->vilresp,
                cpresp: $this->cpresp,
                telresp: $this->telresp,
                emailresp: $this->emailresp,
                password: $this->password,
                assurance: $this->assurance,
                idgalop: $this->idgalop";
    }

    public function getidcava() {
        return $this->idcava;
    }
    
    public function getnomcava() {
        return $this->nomcava;
    }
    
    public function getprenomcava() {
        return $this->prenomcava;
    }
    
    public function getdatenacava() {
        return $this->datenacava;
    }
    
    public function getnumlic() {
        return $this->numlic;
    }
    
    public function getnomresp() {
        return $this->nomresp;
    }
    
    public function getprenomresp() {
        return $this->prenomresp;
    }
    
    public function getrueresp() {
        return $this->rueresp;
    }
    
    public function getvilresp() {
        return $this->vilresp;
    }
    
    public function getcpresp() {
        return $this->cpresp;
    }
    
    public function gettelresp() {
        return $this->telresp;
    }
    
    public function getemailresp() {
        return $this->emailresp;
    }
    
    public function getpassword() {
        return $this->password;
    }
    
    public function getassurance() {
        return $this->assurance;
    }
    
    public function getidgalop() {
        return $this->idgalop;
    }
    
    public function setnomcava($nc) {
        $this->nomcava = $nc;
    }
    
    public function setprenomcava($pc) {
        $this->prenomcava = $pc;
    }
    
    public function setdatenacava($dnc) {
        $this->datenacava = $dnc;
    }
    
    public function setnumlic($nl) {
        $this->numlic = $nl;
    }
    
    public function setnomresp($nr) {
        $this->nomresp = $nr;
    }
    
    public function setprenomresp($pr) {
        $this->prenomresp = $pr;
    }
    
    public function setrueresp($rr) {
        $this->rueresp = $rr;
    }
    
    public function setvilresp($vr) {
        $this->vilresp = $vr;
    }
    
    public function setcpresp($cpr) {
        $this->cpresp = $cpr;
    }
    
    public function settelresp($tr) {
        $this->telresp = $tr;
    }
    
    public function setemailresp($emr) {
        $this->emailresp = $emr;
    }
    
    public function setpassword($pw) {
        $this->password = $pw;
    }
    
    public function setassurance($assu) {
        $this->assurance = $assu;
    }
    
    public function setidgalop($idga) {
        $this->idgalop = $idga;
    }
    

    public function CavaliersALL() {
        try {
            $con = connexionPDO();
            $sql = "SELECT * FROM cavaliers WHERE supprime = 0 OR supprime IS NULL ORDER BY idcava DESC;";
            $executesql = $con->prepare($sql);
            $executesql->execute();
            $resultat = $executesql->fetchAll(PDO::FETCH_ASSOC);
            return $resultat;
        } catch (PDOException $e) {
            error_log("Erreur dans CavaliersALL: " . $e->getMessage());
            return [];
        }
    }
    
    public function CavaliersGalop($id) {
        $con = connexionPDO();
        $sql = "SELECT libgalop
                FROM galop
                WHERE idgalop = :idgalop";
        $data = [':idgalop' => $id];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $ligne = $executesql->fetch();
        return $ligne['libgalop'];
    }


    public function Modifier($id, $nc, $pc, $dnc, $nl, $nr, $pr, $rr, $vr, $cpr, $tr, $emr, $pw, $assu, $idga) {
        $con = connexionPDO();
        $data = [
            ':nomcava' => $nc,
            ':prenomcava' => $pc,
            ':datenacava' => $dnc,
            ':numlic' => $nl,
            ':nomresp' => $nr,
            ':prenomresp' => $pr,
            ':rueresp' => $rr,
            ':vilresp' => $vr,
            ':cpresp' => $cpr,
            ':telresp' => $tr,
            ':emailresp' => $emr,
            ':password' => $pw,
            ':assurance' => $assu,
            ':idgalop' => $idga,
            ':id' => $id
        ];

        $sql = "UPDATE cavaliers 
                SET nomcava = :nomcava, prenomcava = :prenomcava, datenacava = :datenacava, numlic = :numlic,
                    nomresp = :nomresp, prenomresp = :prenomresp, rueresp = :rueresp, vilresp = :vilresp, cpresp = :cpresp, 
                    telresp = :telresp, emailresp = :emailresp, password = :password, assurance = :assurance, idgalop = :idgalop
                WHERE idcava = :id;";
        $stmn = $con->prepare($sql);
        
        if ($stmn->execute($data)) {
            echo "Cavalier modifié";
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
            $sql = "UPDATE cavaliers SET supprime = 1 WHERE idcava = :id;";
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
            error_log("Erreur dans Supprimer: " . $e->getMessage());
            return false;
        }
    }


    public function CavaliersAjt($nc, $pc, $dnc, $nl, $nr, $pr, $rr, $vr, $cpr, $tr, $emr, $pw, $assu, $idga) {
        $con = connexionPDO();
        $data = [
            ':nomcava' => $nc,
            ':prenomcava' => $pc,
            ':datenacava' => $dnc,
            ':numlic' => $nl,
            ':nomresp' => $nr,
            ':prenomresp' => $pr,
            ':rueresp' => $rr,
            ':vilresp' => $vr,
            ':cpresp' => $cpr,
            ':telresp' => $tr,
            ':emailresp' => $emr,
            ':password' => $pw,
            ':assurance' => $assu,
            ':idgalop' => $idga
        ];

        $sql = "INSERT INTO cavaliers (nomcava, prenomcava, datenacava, numlic, nomresp, prenomresp, rueresp, vilresp, cpresp, telresp, emailresp, password, assurance, idgalop) 
                VALUES (:nomcava, :prenomcava, :datenacava, :numlic, :nomresp, :prenomresp, :rueresp, :vilresp, :cpresp, :telresp, :emailresp, :password, :assurance, :idgalop);";
        $stmn = $con->prepare($sql);

        if ($stmn->execute($data)) {
            echo "Cavalier ajouté";
            return true;
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }

    
    public function selectTypeGalop() {
        $con = connexionPDO();
        $sql = "SELECT * FROM galop;";
        $executesql = $con->query($sql);
        return $executesql;
    }

}

?>
