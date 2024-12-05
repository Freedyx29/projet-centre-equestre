<?php

include '../include/bdd.inc.php';

class Cours {

    private $idcours;
    private $libcours;
    private $hdebut;
    private $hfin;
    private $jour;

    public function __construct($idco = null, $libc = null, $hd = null, $hf = null, $j = null) {
        $this->idcours = $idco;
        $this->libcours = $libc;
        $this->hdebut = $hd;
        $this->hfin = $hf;
        $this->jour = $j;
    }


    public function getCours() {
        return "ID cours : $this->idcours,
                Lib courq : $this->libcours,
                Heure début : $this->hdebut,
                Heure Fin : $this->hfin,
                Jour : $this->jour";
    }

    public function getidcours() {
        return $this->idcours;
    }

    public function getlibcours() {
        return $this->libcours;
    }

    public function gethdebut() {
        return $this->hdebut;
    }

    public function gethfin() {
        return $this->hfin;
    }

    public function getjour() {
        return $this->jour;
    }


    public function setlibcours($libc) {
        $this->libcours = $libc;
    }

    public function sethdebut($hd) {
        $this->hdebut = $hd;
    }

    public function sethfin($hf) {
        $this->hfin = $hf;
    }

    public function setjour($j) {
        $this->jour = $j;
    }

        //Requêtes

    //Modèle SELECT : lire
    public function CoursAll(){
        $con = connexionPDO();
        $sql = "SELECT * FROM cours;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }
    

    public function getCavaliersForCours($idcours) {
        $con = connexionPDO();
        $sql = "SELECT c.nomcava, c.idcava 
                FROM cavaliers c 
                JOIN inscrit i ON c.idcava = i.refidcava 
                WHERE i.refidcours = :idcours AND i.supprime = 0";
        $stmt = $con->prepare($sql);
        $stmt->execute([':idcours' => $idcours]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //Modèle UPDATE : modifier
    public function Modifier($id, $libc, $hd, $hf, $j){
        try {
            $con = connexionPDO();
            $con->beginTransaction();

            // 1. Mettre à jour le cours
            $data = [
                ':libc' => $libc,
                ':hd' => $hd,
                ':hf' => $hf,
                ':j' => $j,
                ':id' => $id
            ];
    
            $sql = "UPDATE cours 
                    SET libcours = :libc, hdebut =:hd, hfin = :hf, jour =:j
                    WHERE idcours = :id";
            $stmn = $con->prepare($sql);
            $stmn->execute($data);

            // 2. Supprimer les anciennes occurrences dans le calendrier
            $sqlDelete = "DELETE FROM calendrier WHERE idcoursbase = :id";
            $stmnDelete = $con->prepare($sqlDelete);
            $stmnDelete->execute([':id' => $id]);

            // 3. Ajouter les nouvelles occurrences
            $this->ajouterOccurrencesCalendrier($id, $j);

            $con->commit();
            return true;
        } catch (Exception $e) {
            $con->rollBack();
            error_log("Erreur lors de la modification : " . $e->getMessage());
            return false;
        }
    }


    //Modèle DELETE : supprimer
    public function Supprimer($id) {
        try {
            $con = connexionPDO();
            $con->beginTransaction();

            // 1. Supprimer les inscriptions
            $sqlInscriptions = "UPDATE inscrit SET supprime = 1 WHERE refidcours = :id";
            $stmtInscriptions = $con->prepare($sqlInscriptions);
            $stmtInscriptions->execute([':id' => $id]);

            // 2. Marquer les entrées du calendrier comme supprimées
            $sqlCalendrier = "UPDATE calendrier SET supprime = 1 WHERE idcoursbase = :id";
            $stmnCalendrier = $con->prepare($sqlCalendrier);
            $stmnCalendrier->execute([':id' => $id]);

            // 3. Marquer le cours comme supprimé
            $sqlCours = "UPDATE cours SET supprime = 1 WHERE idcours = :id";
            $stmnCours = $con->prepare($sqlCours);
            $stmnCours->execute([':id' => $id]);

            $con->commit();
            return true;
        } catch (Exception $e) {
            $con->rollBack();
            error_log("Erreur lors de la suppression : " . $e->getMessage());
            return false;
        }
    }
    

    //Modèle INSERT : créer
    public function CoursAjt($libcours, $hdebut, $hfin, $jour){
        $con = connexionPDO();
        $data = [
            ':libcours' => $libcours,
            ':hdebut' => $hdebut,
            ':hfin' => $hfin,
            ':jour' => $jour,
        ];
    
        $sql = "INSERT INTO cours (libcours, hdebut, hfin, jour) VALUES (:libcours, :hdebut, :hfin, :jour);";
        $stmn = $con->prepare($sql);
    
        if ($stmn->execute($data)) {
            $idcours = $con->lastInsertId();
            echo "Cours insérée";

            // Ajouter les occurrences dans le calendrier
            $this->ajouterOccurrencesCalendrier($idcours, $jour);

            return $idcours;
        } else {
            echo $stmn->errorInfo();
            return false;
        }
    }

    private function ajouterOccurrencesCalendrier($idcours, $jour): void {
        $con = connexionPDO();
        $year = date('Y');

        $joursEn = [
            'LUNDI' => 'Monday',
            'MARDI' => 'Tuesday',
            'MERCREDI' => 'Wednesday',
            'JEUDI' => 'Thursday',
            'VENDREDI' => 'Friday',
            'SAMEDI' => 'Saturday',
            'DIMANCHE' => 'Sunday'
        ];

        $jour = strtoupper($jour);
        if (!isset($joursEn[$jour])) {
            throw new Exception("Jour invalide : $jour");
        }
        $jourEn = $joursEn[$jour];

        $startDate = new DateTime("first $jourEn of January $year");
        $endDate = new DateTime("last day of December $year");

        // Créer les occurrences dans calendrier
        while ($startDate <= $endDate) {
            $data = [
                ':idcoursbase' => $idcours,
                ':datecours' => $startDate->format('Y-m-d'),
            ];

            $sql = "INSERT INTO calendrier (idcoursbase, datecours) 
                    VALUES (:idcoursbase, :datecours)";
            $stmn = $con->prepare($sql);
            $stmn->execute($data);

            $startDate->modify('+1 week');
        }
    }    

    public function ajouterInscription($idcours, $idcava) {
        try {
            $con = connexionPDO();
            $sql = "INSERT INTO inscrit (refidcours, refidcava) VALUES (:idcours, :idcava)";
            $stmt = $con->prepare($sql);
            return $stmt->execute([
                ':idcours' => $idcours,
                ':idcava' => $idcava
            ]);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de l'inscription : " . $e->getMessage());
            return false;
        }
    }

}

?>
