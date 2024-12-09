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
    public function CoursAjt($libcours, $hdebut, $hfin, $jour, $cavaliers) {
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
    
            // Ajouter les occurrences dans le calendrier
            $seances = $this->ajouterOccurrencesCalendrier($idcours, $jour);
    
            // Ajouter les inscriptions
            $this->ajouterInscription($idcours, $cavaliers);
    
            // Ajouter les participations
            $this->ajouterParticipations($idcours, $seances, $cavaliers);
    
            return $idcours;
        } else {
            return false;
        }
    }
    

    private function ajouterOccurrencesCalendrier($idcours, $jour): array {
        $con = connexionPDO(); // Établit une connexion à la base de données
        $year = date('Y'); // Récupère l'année actuelle

        // Tableau de correspondance entre les jours en français et en anglais
        $joursEn = [
            'LUNDI' => 'Monday',
            'MARDI' => 'Tuesday',
            'MERCREDI' => 'Wednesday',
            'JEUDI' => 'Thursday',
            'VENDREDI' => 'Friday',
            'SAMEDI' => 'Saturday',
            'DIMANCHE' => 'Sunday'
        ];

        $jour = strtoupper($jour); // Convertit le jour en majuscules
        // Vérifie si le jour fourni est valide
        if (!isset($joursEn[$jour])) {
            throw new Exception("Jour invalide : $jour");
        }
        $jourEn = $joursEn[$jour]; // Récupère le jour en anglais

        // Définit la date de début comme le premier jour du jour spécifié de l'année
        $startDate = new DateTime("first $jourEn of January $year");
        // Définit la date de fin comme le dernier jour de l'année
        $endDate = new DateTime("last day of December $year");

        // Vérifie si le cours existe avant d'ajouter des occurrences
        $stmtCours = $con->prepare("SELECT COUNT(*) FROM cours WHERE idcours = :idcours");
        $stmtCours->execute([':idcours' => $idcours]);
        if ($stmtCours->fetchColumn() == 0) {
            throw new Exception("Cours ID $idcours n'existe pas.");
        }

        $seances = []; // Tableau pour stocker les ID des séances créées

        // Créer les occurrences dans le calendrier
        while ($startDate <= $endDate) {
            $data = [
                ':idcoursbase' => $idcours,
                ':datecours' => $startDate->format('Y-m-d'), // Formate la date pour l'insertion
            ];

            // Insère une nouvelle occurrence dans la table calendrier
            $sql = "INSERT INTO calendrier (idcoursbase, datecours)
                    VALUES (:idcoursbase, :datecours)";
            $stmn = $con->prepare($sql);
            $stmn->execute($data);

            $seances[] = $con->lastInsertId(); // Ajoute l'ID de la séance créée au tableau

            $startDate->modify('+1 week'); // Passe à la semaine suivante
        }

        return $seances; // Retourne le tableau des ID des séances créées
    }
    
    

    private function ajouterInscription($idcours, $cavaliers): void {
        $con = connexionPDO(); // Établit une connexion à la base de données

        // Parcourt chaque cavalier pour ajouter une inscription
        foreach ($cavaliers as $cavalierId) {
            $data = [
                ':refidcours' => $idcours, // ID du cours
                ':refidcava' => $cavalierId, // ID du cavalier
            ];

            // Insère une nouvelle inscription dans la table inscrit
            $sql = "INSERT INTO inscrit (refidcours, refidcava)
                    VALUES (:refidcours, :refidcava)";
            $stmn = $con->prepare($sql);
            $stmn->execute($data); // Exécute la requête
        }
    }
    

    private function ajouterParticipations($idcours, $seances, $cavaliers): void {
        $con = connexionPDO(); // Établit une connexion à la base de données

        // Parcourt chaque séance pour ajouter des participations
        foreach ($seances as $seanceId) {
            foreach ($cavaliers as $cavalierId) {
                $data = [
                    ':refidcava' => $cavalierId, // ID du cavalier
                    ':refidcoursbase' => $idcours, // ID du cours
                    ':refidcoursseance' => $seanceId, // ID de la séance
                    ':participe' => 1, // Indique que le cavalier participe
                ];

                // Insère une nouvelle participation dans la table participe
                $sql = "INSERT INTO participe (refidcava, refidcoursbase, refidcoursseance, participe)
                        VALUES (:refidcava, :refidcoursbase, :refidcoursseance, :participe)";
                $stmn = $con->prepare($sql);
                $stmn->execute($data); // Exécute la requête
            }
        }
    }

}

?>
