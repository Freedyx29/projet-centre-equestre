<?php
include_once '../include/bdd.inc.php';

class Evenements {
    private $ideve;
    private $titre;
    private $commentaire;
    private $photo;

    public function __construct($ide = null, $tt = null, $cmt = null, $ph = null) {
        $this->ideve = $ide;
        $this->titre = $tt;
        $this->commentaire = $cmt;
        $this->photo = $ph;
    }

    public function getEvenements() {
        return "id évènement : $this->ideve,
                titre : $this->titre,
                commentaire : $this->commentaire";
    }

    public function getideve() {
        return $this->ideve;
    }

    public function gettitre() {
        return $this->titre;
    }

    public function getcommentaire() {
        return $this->commentaire;
    }

    public function getphoto() {
        return $this->photo;
    }

    public function settitre($tt) {
        $this->titre = $tt;
    }

    public function setcommentaire($cmt) {
        $this->commentaire = $cmt;
    }

    public function setphoto($ph) {
        $this->photo = $ph;
    }


    public function EvenementsAll(){
        $con = connexionPDO();
        $sql = "SELECT * FROM evenements;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }


    public function getSinglePhotoByIEve($ideve) {
        $con = connexionPDO();
        $sql = "SELECT lienphoto FROM photos WHERE ideve = :ideve LIMIT 1";
        $data = [':ideve' => $ideve];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $resultat = $executesql->fetch();
        return $resultat ? $resultat['lienphoto'] : null;
    }


    public function Modifier($id, $tt, $cmt){
        $con = connexionPDO();
        $data = [
            ':tt' => $tt,
            ':cmt' => $cmt,
            ':id' => $id
        ];

        $sql = "UPDATE evenements
                SET titre = :tt,
                    commentaire = :cmt
                WHERE ideve = :id;";
        $stmn = $con->prepare($sql);

        if ($stmn->execute($data)) {
            echo "Evènement modifié";
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

            $sql = "UPDATE evenements SET supprime = 1 WHERE ideve = :id;";
            $stmn = $con->prepare($sql);

            $result = $stmn->execute($data);

            if ($result) {
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

    public function EvenementsAjt($titre, $commentaire){
        $con = connexionPDO();
        $data = [
            ':titre' => $titre,
            ':commentaire' => $commentaire,
        ];

        $sql = "INSERT INTO evenements (titre, commentaire)
                VALUES (:titre, :commentaire);";
        $stmn = $con->prepare($sql);

        if ($stmn->execute($data)) {
            echo "Evènement inséré";
            return $con->lastInsertId();
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }



    public function ajouterPhotoEve($ideve, $photo) {
        $con = connexionPDO();
        $data = [
            ':ideve' => $ideve,
            ':lienphoto' => $photo
        ];

        $sql = "INSERT INTO photos (ideve, lienphoto) VALUES (:ideve, :lienphoto);";
        $stmm = $con->prepare($sql);

        if ($stmm->execute($data)) {
            echo "Photo insérée";
            return true;
        } else {
            echo $stmm->errorInfo();
            return false;
        }
    }



    // Méthode pour récupérer toutes les photos d'une cavalerie par ideve
    public function getPhotosByIdEve($ideve) {
        $con = connexionPDO();
        $sql = "SELECT idphotos, lienphoto FROM photos WHERE ideve = :ideve";
        $data = [':ideve' => $ideve];
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
