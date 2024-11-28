<?php

include_once '../include/bdd.inc.php';

class Evenements {

    private $ideve;
    private $titre;
    private $commentaire;

    public function __construct($ide = null, $tt = null, $cmt = null) {
        $this->ideve = $ide;
        $this->titre = $tt;
        $this->commentaire = $cmt;
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


    public function settitre($tt) {
        $this->titre = $tt;
    }

    public function setcommentaire($cmt) {
        $this->commentaire = $cmt;
    }


    public function EvenementsAll(){
        $con = connexionPDO();
        $sql = "SELECT * FROM evenements;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
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
}

?>
