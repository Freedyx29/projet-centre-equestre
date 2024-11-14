<?php

include_once '../include/bdd.inc.php';

class Inscrit {

    private $idcours;
    private $idcava;

    function __construct($ic = null, $ica = null) {
        $this->idcours = $ic;
        $this->idcava = $ica;
    }

    public function getidcours() {
        return $this->idcours;
    }

    public function getidcava() {
        return $this->idcava;
    }

    public function setidcours($ic) {
        $this->idcours = $ic;
    }

    public function setidcava($ica) {
        $this->idcava = $ica;
    }

    // Requêtes

    // Modèle SELECT : lire toutes les inscriptions
    public function InscritALL() {
        $con = connexionPDO();
        $sql = "SELECT i.idcours, i.idcava, c.libcours, ca.nomcava
                FROM inscrit i
                JOIN cours c ON i.idcours = c.idcours
                JOIN cavaliers ca ON i.idcava = ca.idcava
                WHERE i.supprime = 0;";
        $executesql = $con->prepare($sql);
        $executesql->execute();
        $resultat = $executesql->fetchAll();
        return $resultat;
    }

    // Modèle UPDATE : modifier une inscription
public function Modifier($new_idcours, $new_idcava) {
    $con = connexionPDO();
    $data = [
        ':new_idcours' => $new_idcours,
        ':new_idcava' => $new_idcava,
        ':idcours' => $this->getidcours(),
        ':idcava' => $this->getidcava()
    ];

    // Vérifier si les nouvelles valeurs créent un duplicata
    $sql_check = "SELECT COUNT(*) FROM inscrit WHERE idcours = :new_idcours AND idcava = :new_idcava AND supprime = 0 AND NOT (idcours = :idcours AND idcava = :idcava);";
    $stmm_check = $con->prepare($sql_check);
    $stmm_check->execute($data);
    $count = $stmm_check->fetchColumn();

    if ($count > 0) {
        echo "Erreur : Les nouvelles valeurs créent un duplicata.";
        return false;
    }

    $sql = "UPDATE inscrit
            SET idcours = :new_idcours, idcava = :new_idcava
            WHERE idcours = :idcours AND idcava = :idcava;";
    $stmm = $con->prepare($sql);

    if ($stmm->execute($data)) {
        echo "Inscription modifiée";
        return true;
    } else {
        echo $stmm->errorInfo();
        return false;
    }
}





    // Modèle DELETE : supprimer logiquement
    public function Supprimer($idcours, $idcava) {
        $con = connexionPDO();
        $data = [
            ':idcours' => $idcours,
            ':idcava' => $idcava
        ];

        $sql = "UPDATE inscrit SET supprime = 1 WHERE idcours = :idcours AND idcava = :idcava;";
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
public function InscritAjt($idcours, $idcava) {
    $con = connexionPDO();
    $data = [
        ':idcours' => $idcours,
        ':idcava' => $idcava
    ];

    $sql = "INSERT INTO inscrit (idcours, idcava)
            SELECT :idcours, :idcava
            WHERE (SELECT COUNT(*) FROM inscrit WHERE idcours = :idcours AND idcava = :idcava) = 0;";
    $stmm = $con->prepare($sql);

    if ($stmm->execute($data)) {
        echo "Inscription insérée";
        return $con->lastInsertId();
    } else {
        echo "Erreur d'insertion: " . implode(", ", $stmm->errorInfo());
        return false;
    }
}


    // Méthode pour récupérer les informations actuelles d'une inscription par idcours et idcava
    public function getInscritById($idcours, $idcava) {
        $con = connexionPDO();
        $sql = "SELECT * FROM inscrit WHERE idcours = :idcours AND idcava = :idcava";
        $data = [':idcours' => $idcours, ':idcava' => $idcava];
        $executesql = $con->prepare($sql);
        $executesql->execute($data);
        $resultat = $executesql->fetch();
        return $resultat;
    }
}

?>
