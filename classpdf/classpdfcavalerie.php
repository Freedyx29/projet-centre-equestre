<?php

include_once '../include/bdd.inc.php';

class Cavalerie {

    private $numsire;
    private $nomche;
    private $datenache;
    private $garrot;
    private $idrace;
    private $idrobe;
    private $photo;

    function __construct($ns = null, $nc = null, $dn = null, $gr = null, $ir = null, $irb = null, $ph = null) {
        $this->numsire = $ns;
        $this->nomche = $nc;
        $this->datenache = $dn;
        $this->garrot = $gr;
        $this->idrace = $ir;
        $this->idrobe = $irb;
        $this->photo = $ph;
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

    public function getphoto() {
        return $this->photo;
    }

    public function setnomche($nc) {
        $this->nomche = $nc;
    }

    public function setdatenache($dn) {
        $this->datenache = $dn;
    }

    public function setgarrot($gr) {
        $this->garrot = $gr;
    }

    public function setidrace($ir) {
        $this->idrace = $ir;
    }

    public function setidrobe($irb) {
        $this->idrobe = $irb;
    }

    public function setphoto($ph) {
        $this->photo = $ph;
    }

    // Requêtes

    // Modèle SELECT : lire
    public function CavalerieALL(){
        $con = connexionPDO();
        $sql = "SELECT * FROM cavalerie WHERE supprime = 0;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }
 public function getSinglePhotoByNumsire($numsire) {
        $con = connexionPDO();
        $sql = "SELECT lienphoto FROM photos WHERE numsire = :numsire LIMIT 1";
        $data = [':numsire' => $numsire];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $resultat = $executesql->fetch();
        return $resultat ? $resultat['lienphoto'] : null;
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

    // Modèle UPDATE : modifier
   public function Modifier($numsire, $nomche, $datenache, $garrot, $idrace, $idrobe){
    $con = connexionPDO();
    $data = [
        ':nomche' => $nomche,
        ':datenache' => $datenache,
        ':garrot' => $garrot,
        ':idrace' => $idrace,
        ':idrobe' => $idrobe,
        ':numsire' => $numsire
    ];

    $sql = "UPDATE cavalerie
            SET nomche = :nomche, datenache = :datenache, garrot = :garrot, idrace = :idrace, idrobe = :idrobe
            WHERE numsire = :numsire";
    $stmm = $con->prepare($sql);

    if ($stmm->execute($data)) {
        echo "Cavalerie modifiée";
        return true;
    } else {
        echo $stmm->errorInfo();
        return false;
    }
}

    // Modèle DELETE : supprimer logiquement
    public function Supprimer($numsire) {
        $con = connexionPDO();
        $data = [
            ':numsire' => $numsire
        ];

        $sql = "UPDATE cavalerie SET supprime = 1 WHERE numsire = :numsire;";
        $stmm = $con->prepare($sql);

        if ($stmm->execute($data)) {
            echo "Suppression réussie";
            return true;
        } else {
            $errorInfo = $stmm->errorInfo();
            echo "Erreur lors de la suppression : " . $errorInfo[2];
            return false;
        }
    }

    // Modèle INSERT : créer
  public function CavalerieAjt($nomche, $datenache, $garrot, $idrace, $idrobe){
    $con = connexionPDO();
    $data = [
        ':nomche' => $nomche,
        ':datenache' => $datenache,
        ':garrot' => $garrot,
        ':idrace' => $idrace,
        ':idrobe' => $idrobe
    ];

    $sql = "INSERT INTO cavalerie (nomche, datenache, garrot, idrace, idrobe) VALUES (:nomche, :datenache, :garrot, :idrace, :idrobe);";
    $stmm = $con->prepare($sql);

    if ($stmm->execute($data)) {
        echo "Cavalerie insérée";
        return $con->lastInsertId();
    } else {
        echo $stmm->errorInfo();
        return false;
    }
}


    // Méthode pour récupérer les informations actuelles d'une cavalerie par numsire
    public function getCavalerieByNumsire($numsire) {
        $con = connexionPDO();
        $sql = "SELECT * FROM cavalerie WHERE numsire = :numsire";
        $data = [':numsire' => $numsire];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $resultat = $executesql->fetch();
        return $resultat;
    }

    // Méthode pour ajouter une photo à la table photos
    public function ajouterPhoto($numsire, $photo) {
        $con = connexionPDO();
        $data = [
            ':numsire' => $numsire,
            ':lienphoto' => $photo
        ];

        $sql = "INSERT INTO photos (numsire, lienphoto) VALUES (:numsire, :lienphoto);";
        $stmm = $con->prepare($sql);

        if ($stmm->execute($data)) {
            echo "Photo insérée";
            return true;
        } else {
            echo $stmm->errorInfo();
            return false;
        }
    }

    // Méthode pour récupérer toutes les photos d'une cavalerie par numsire
    public function getPhotosByNumsire($numsire) {
        $con = connexionPDO();
        $sql = "SELECT idphotos, lienphoto FROM photos WHERE numsire = :numsire";
        $data = [':numsire' => $numsire];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $resultat = $executesql->fetchAll();
        return $resultat;
    }

    // Méthode pour supprimer une photo spécifique de la table photos
    public function supprimerPhoto($idphotos) {
        $con = connexionPDO();
        $data = [
            ':idphotos' => $idphotos
        ];

        $sql = "DELETE FROM photos WHERE idphotos = :idphotos";
        $stmm = $con->prepare($sql);

        if ($stmm->execute($data)) {
            echo "Photo supprimée";
            return true;
        } else {
            echo $stmm->errorInfo();
            return false;
        }
    }
}

?>
