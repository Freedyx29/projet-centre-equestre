<?php

include_once '../include/bdd.inc.php';

class Evenements {

    private $ideve;
    private $titre;
    private $commentaire;
    private $supprime;

    function __construct($ideve = null, $titre = null, $commentaire = null, $supprime = 0) {
        $this->ideve = $ideve;
        $this->titre = $titre;
        $this->commentaire = $commentaire;
        $this->supprime = $supprime;
    }

    public function getEvenement() {
        return "id: $this->ideve, titre: $this->titre, commentaire: $this->commentaire, supprime: $this->supprime";
    }

    public function getId() {
        return $this->ideve;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getCommentaire() {
        return $this->commentaire;
    }

    public function getSupprime() {
        return $this->supprime;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function setCommentaire($commentaire) {
        $this->commentaire = $commentaire;
    }

    public function setSupprime($supprime) {
        $this->supprime = $supprime;
    }

    // SELECT - Lire tous les événements
    public function getAllEvenements() {
        $con = connexionPDO();
        $sql = "SELECT * FROM evenements WHERE supprime = 0;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        return $executesql->fetchAll();
    }

    // INSERT - Ajouter un événement
    public function ajouterEvenement($titre, $commentaire) {
        $con = connexionPDO();
        $data = [
            ':titre' => $titre,
            ':commentaire' => $commentaire
        ];
        $sql = "INSERT INTO evenements (titre, commentaire) VALUES (:titre, :commentaire);";
        $stmm = $con->prepare($sql);
        if ($stmm->execute($data)) {
            echo "Événement ajouté";
            return $con->lastInsertId();
        } else {
            echo $stmm->errorInfo();
            return false;
        }
    }

    // UPDATE - Modifier un événement
    public function modifierEvenement($ideve, $titre, $commentaire) {
        $con = connexionPDO();
        $data = [
            ':titre' => $titre,
            ':commentaire' => $commentaire,
            ':ideve' => $ideve
        ];
        $sql = "UPDATE evenements SET titre = :titre, commentaire = :commentaire WHERE ideve = :ideve;";
        $stmm = $con->prepare($sql);
        return $stmm->execute($data);
    }

    // DELETE - Supprimer (soft delete) un événement
    public function supprimerEvenement($ideve) {
        $con = connexionPDO();
        $data = [
            ':ideve' => $ideve
        ];
        $sql = "UPDATE evenements SET supprime = 1 WHERE ideve = :ideve;";
        $stmm = $con->prepare($sql);
        return $stmm->execute($data);
    }
}
?>
