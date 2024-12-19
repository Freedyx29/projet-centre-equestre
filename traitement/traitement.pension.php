<?php
include_once '../include/bdd.inc.php';
include_once '../class/class.pension.php';

$opension = new Pension();

if (isset($_POST['ajouter'])) {
    $libpen = $_POST['libpen'];
    $dateD = $_POST['dateD'];
    $dateF = $_POST['dateF'];
    $tarif = $_POST['tarif'];
    $numsire = $_POST['numsire'];
    $idcava1 = $_POST['idcava1'];
    $idcava2 = isset($_POST['idcava2']) ? $_POST['idcava2'] : null;

    // Validation des dates
    if (strtotime($dateD) > strtotime($dateF)) {
        header('Location: ../vue/vue.pension.php?success=0&message=La date de début ne peut pas être plus récente que la date de fin');
        exit();
    }

    error_log("Données reçues pour l'ajout : libpen=$libpen, dateD=$dateD, dateF=$dateF, tarif=$tarif, numsire=$numsire, idcava1=$idcava1, idcava2=$idcava2");

    // Vérifiez si les IDs des cavaliers existent dans la table `cavaliers`
    $con = connexionPDO();
    $sqlCheck = "SELECT COUNT(*) FROM cavaliers WHERE idcava = :idcava";
    $stmtCheck = $con->prepare($sqlCheck);
    $stmtCheck->bindParam(':idcava', $idcava1, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count1 = $stmtCheck->fetchColumn();

    if ($idcava2) {
        $stmtCheck->bindParam(':idcava', $idcava2, PDO::PARAM_INT);
        $stmtCheck->execute();
        $count2 = $stmtCheck->fetchColumn();
    } else {
        $count2 = 1; // Si idcava2 est null, on considère qu'il est valide
    }

    // Vérifiez si `numsire` existe dans la table `cavalerie`
    $sqlCheckNumsire = "SELECT COUNT(*) FROM cavalerie WHERE numsire = :numsire";
    $stmtCheckNumsire = $con->prepare($sqlCheckNumsire);
    $stmtCheckNumsire->bindParam(':numsire', $numsire, PDO::PARAM_INT);
    $stmtCheckNumsire->execute();
    $countNumsire = $stmtCheckNumsire->fetchColumn();

    if ($count1 > 0 && $count2 > 0 && $countNumsire > 0) {
        $idpen = $opension->PensionAjt($libpen, $dateD, $dateF, $tarif, $numsire);

        if ($idpen) {
            $data = [
                ':refidcava' => $idcava1,
                ':redifpen' => $idpen
            ];

            $sql = "INSERT INTO prend (refidcava, redifpen) VALUES (:refidcava, :redifpen);";
            $stmn = $con->prepare($sql);

            if ($stmn->execute($data)) {
                if ($idcava2) {
                    $data = [
                        ':refidcava' => $idcava2,
                        ':redifpen' => $idpen
                    ];

                    $sql = "INSERT INTO prend (refidcava, redifpen) VALUES (:refidcava, :redifpen);";
                    $stmn = $con->prepare($sql);

                    if ($stmn->execute($data)) {
                        header('Location: ../vue/vue.pension.php?success=1&message=Pension ajoutée avec succès');
                        exit();
                    } else {
                        error_log("Erreur lors de l'ajout du deuxième cavalier");
                        header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de l\'ajout du deuxième cavalier');
                        exit();
                    }
                } else {
                    header('Location: ../vue/vue.pension.php?success=1&message=Pension ajoutée avec succès');
                    exit();
                }
            } else {
                error_log("Erreur lors de l'ajout du premier cavalier");
                header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de l\'ajout du premier cavalier');
                exit();
            }
        } else {
            error_log("Erreur lors de l'ajout de la pension");
            header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de l\'ajout de la pension');
            exit();
        }
    } else {
        error_log("L'ID d'un des cavaliers ou le numéro SIRE n'existe pas");
        header('Location: ../vue/vue.pension.php?success=0&message=L\'ID d\'un des cavaliers ou le numéro SIRE n\'existe pas');
        exit();
    }
}

if (isset($_POST['modifier'])) {
    $idpen = $_POST['idpen'];
    $libpen = $_POST['libpen'];
    $dateD = $_POST['dateD'];
    $dateF = $_POST['dateF'];
    $tarif = $_POST['tarif'];
    $numsire = $_POST['numsire'];
    $idcava1 = $_POST['idcava3']; // Utilisez idcava3 pour le premier cavalier
    $idcava2 = isset($_POST['idcava4']) ? $_POST['idcava4'] : null; // Utilisez idcava4 pour le deuxième cavalier

    // Validation des dates
    if (strtotime($dateD) > strtotime($dateF)) {
        header('Location: ../vue/vue.pension.php?success=0&message=La date de début ne peut pas être plus récente que la date de fin');
        exit();
    }

    error_log("Données reçues pour la modification : idpen=$idpen, libpen=$libpen, dateD=$dateD, dateF=$dateF, tarif=$tarif, numsire=$numsire, idcava1=$idcava1, idcava2=$idcava2");

    // Vérifiez si les IDs des cavaliers existent dans la table `cavaliers`
    $con = connexionPDO();
    $sqlCheck = "SELECT COUNT(*) FROM cavaliers WHERE idcava = :idcava";
    $stmtCheck = $con->prepare($sqlCheck);

    $stmtCheck->bindParam(':idcava', $idcava1, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count1 = $stmtCheck->fetchColumn();

    if ($idcava2) {
        $stmtCheck->bindParam(':idcava', $idcava2, PDO::PARAM_INT);
        $stmtCheck->execute();
        $count2 = $stmtCheck->fetchColumn();
    } else {
        $count2 = 1; // Si idcava2 est null, on considère qu'il est valide
    }

    if ($count1 > 0 && $count2 > 0) {
        $success = $opension->Modifier($idpen, $libpen, $dateD, $dateF, $tarif, $numsire);

        if ($success) {
            $opension->updateCavaliers($idpen, $idcava1, $idcava2);
            header('Location: ../vue/vue.pension.php?success=1&message=Pension modifiée avec succès');
            exit();
        } else {
            header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de la modification de la pension');
            exit();
        }
    } else {
        header('Location: ../vue/vue.pension.php?success=0&message=L\'ID du cavalier n\'existe pas');
        exit();
    }
}


if (isset($_POST['supprimer'])) {
    $idpen = $_POST['idpen'];
    $success = $opension->Supprimer($idpen) ? 1 : 0;
    header('Location: ../vue/vue.pension.php?success=1&message=Pension supprimée avec succès');
    exit();
}
?>
