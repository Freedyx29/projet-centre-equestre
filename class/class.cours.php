<?php

include_once '../include/bdd.inc.php';

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
    public function Modifier($id, $l, $hd, $hf, $j) {
        try {
            $con = connexionPDO();
            $con->beginTransaction();
    
            // 1. Récupérer les anciennes informations du cours
            $sqlOld = "SELECT jour, hdebut, hfin FROM cours WHERE idcours = :id";
            $stmtOld = $con->prepare($sqlOld);
            $stmtOld->execute([':id' => $id]);
            $oldData = $stmtOld->fetch(PDO::FETCH_ASSOC);
            $oldDay = $oldData['jour'];
            $oldHdebut = $oldData['hdebut'];
            $oldHfin = $oldData['hfin'];
    
            // 2. Mettre à jour le cours
            $sql = "UPDATE cours 
                    SET libcours = :lib, 
                        hdebut = :hd, 
                        hfin = :hf, 
                        jour = :j
                    WHERE idcours = :id";
            $data = [
                ':lib' => $l,
                ':hd' => $hd,
                ':hf' => $hf,
                ':j' => $j,
                ':id' => $id
            ];
            $stmt = $con->prepare($sql);
            $stmt->execute($data);
    
            // 3. Si le jour a changé, ajuster les dates dans calendrier
            if ($oldDay !== $j) {
                // Tableau de correspondance des jours (1 = Lundi, 7 = Dimanche)
                $joursEn = [
                    'LUNDI' => 1,
                    'MARDI' => 2,
                    'MERCREDI' => 3,
                    'JEUDI' => 4,
                    'VENDREDI' => 5,
                    'SAMEDI' => 6,
                    'DIMANCHE' => 7
                ];
    
                // Convertir les jours en nombres
                $oldDayNum = $joursEn[strtoupper($oldDay)];
                $newDayNum = $joursEn[strtoupper($j)];
                $dayDiff = $newDayNum - $oldDayNum;
    
                // Mettre à jour les dates dans calendrier
                $sqlUpdateCalendrier = "UPDATE calendrier 
                                        SET datecours = DATE_ADD(datecours, INTERVAL :dayDiff DAY) 
                                        WHERE idcoursbase = :id AND supprime = 0";
                $stmtUpdateCalendrier = $con->prepare($sqlUpdateCalendrier);
                $stmtUpdateCalendrier->execute([
                    ':dayDiff' => $dayDiff,
                    ':id' => $id
                ]);
            }
    
            // 4. Si les heures ont changé, elles sont déjà mises à jour dans cours
            // FullCalendar récupérera les nouvelles heures via getEvents.php, pas besoin d'action supplémentaire ici
    
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
            $this->ajouterInscription($idcours, $cavaliers, $seances);
    
            // Ajouter les participations
            $this->ajouterParticipations($idcours, $seances, $cavaliers);
    
            return $idcours;
        } else {
            return false;
        }
    }
    

    public function ajouterOccurrencesCalendrier($idcours, $jour): array {
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
    
        $stmtCours = $con->prepare("SELECT COUNT(*) FROM cours WHERE idcours = :idcours");
        $stmtCours->execute([':idcours' => $idcours]);
        if ($stmtCours->fetchColumn() == 0) {
            throw new Exception("Cours ID $idcours n'existe pas.");
        }
    
        $seances = [];
    
        while ($startDate <= $endDate) {
            $datecours = $startDate->format('Y-m-d');
    
            // Vérifier si la séance existe déjà
            $checkSql = "SELECT idcoursseance FROM calendrier 
                         WHERE idcoursbase = :idcoursbase AND datecours = :datecours AND supprime = 0";
            $checkStmt = $con->prepare($checkSql);
            $checkStmt->execute([':idcoursbase' => $idcours, ':datecours' => $datecours]);
            $existingSeance = $checkStmt->fetchColumn();
    
            if ($existingSeance) {
                $seances[] = $existingSeance; // Réutiliser la séance existante
            } else {
                $data = [
                    ':idcoursbase' => $idcours,
                    ':datecours' => $datecours,
                ];
                $sql = "INSERT INTO calendrier (idcoursbase, datecours)
                        VALUES (:idcoursbase, :datecours)";
                $stmn = $con->prepare($sql);
                $stmn->execute($data);
                $seances[] = $con->lastInsertId(); // Ajouter la nouvelle séance
            }
    
            $startDate->modify('+1 week');
        }
    
        return $seances;
    }
    
    

    private function ajouterInscription($idcours, $cavaliers, $seances): void {
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

            // Ajoutez la participation dans la table participe
            $this->ajouterParticipations($idcours, $seances, [$cavalierId]);
        }
    }
    

    public function ajouterParticipations($idcours, $seances, $cavaliers): void {
        $con = connexionPDO();

        foreach ($seances as $seanceId) {
            foreach ($cavaliers as $cavalierId) {
                // Vérifiez si la participation existe déjà
                $checkSql = "SELECT COUNT(*) FROM participe WHERE refidcava = :refidcava AND refidcoursseance = :refidcoursseance";
                $checkStmt = $con->prepare($checkSql);
                $checkStmt->execute([
                    ':refidcava' => $cavalierId,
                    ':refidcoursseance' => $seanceId
                ]);

                if ($checkStmt->fetchColumn() == 0) { // Si la participation n'existe pas
                    $data = [
                        ':refidcava' => $cavalierId,
                        ':refidcoursbase' => $idcours,
                        ':refidcoursseance' => $seanceId,
                        ':participe' => 0,
                    ];

                    $sql = "INSERT INTO participe (refidcava, refidcoursbase, refidcoursseance, participe)
                            VALUES (:refidcava, :refidcoursbase, :refidcoursseance, :participe)";
                    $stmn = $con->prepare($sql);
                    $stmn->execute($data);
                }
            }
        }
    }
}

?>
