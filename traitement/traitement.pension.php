<?php
include '../class/class.pension.php';

$opension = new Pension();

if (isset($_POST['ajouter'])) {
    $libpen = $_POST['libpen'];
    $dateD = $_POST['dateD'];
    $dateF = $_POST['dateF'];
    $tarif = $_POST['tarif'];
    $numsire = $_POST['numsire'];
    $idcava1 = $_POST['idcava1'];
    $idcava2 = $_POST['idcava2'];

    // Vérifiez si les IDs des cavaliers existent dans la table `cavaliers`
    $con = connexionPDO();
    $sqlCheck = "SELECT COUNT(*) FROM cavaliers WHERE idcava = :idcava";
    $stmtCheck = $con->prepare($sqlCheck);
    $stmtCheck->bindParam(':idcava', $idcava1, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count1 = $stmtCheck->fetchColumn();

    $stmtCheck->bindParam(':idcava', $idcava2, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count2 = $stmtCheck->fetchColumn();

    if ($count1 > 0 && $count2 > 0) {
        $idpen = $opension->PensionAjt($libpen, $dateD, $dateF, $tarif, $numsire);

        if ($idpen) {
            $data = [
                ':refidcava' => $idcava1,
                ':refidpen' => $idpen
            ];

            $sql = "INSERT INTO prend (refidcava, refidpen) VALUES (:refidcava, :refidpen);";
            $stmn = $con->prepare($sql);

            if ($stmn->execute($data)) {
                $data = [
                    ':refidcava' => $idcava2,
                    ':refidpen' => $idpen
                ];

                $sql = "INSERT INTO prend (refidcava, refidpen) VALUES (:refidcava, :refidpen);";
                $stmn = $con->prepare($sql);

                if ($stmn->execute($data)) {
                    header('Location: ../vue/vue.pension.php?success=1&message=Pension ajoutée avec succès');
                    exit();
                } else {
                    header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de l\'ajout du deuxième cavalier');
                    exit();
                }
            } else {
                header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de l\'ajout du premier cavalier');
                exit();
            }
        } else {
            header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de l\'ajout de la pension');
            exit();
        }
    } else {
        header('Location: ../vue/vue.pension.php?success=0&message=L\'ID d\'un des cavaliers n\'existe pas');
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
   
     $idcava3 = $_POST['idcava3'];
     $idcava4 = $_POST['idcava4'];
     
    error_log("Données reçues pour la modification : idpen=$idpen, libpen=$libpen, dateD=$dateD, dateF=$dateF, tarif=$tarif, numsire=$numsire, idcava1=$idcava1, idcava2=$idcava2");

    // Vérifiez si les IDs des cavaliers existent dans la table `cavaliers`
    $con = connexionPDO();
    $sqlCheck = "SELECT COUNT(*) FROM cavaliers WHERE idcava = :idcava";
    $stmtCheck = $con->prepare($sqlCheck);

    $stmtCheck->bindParam(':idcava', $idcava3, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count1 = $stmtCheck->fetchColumn();

    $stmtCheck->bindParam(':idcava', $idcava4, PDO::PARAM_INT);
    $stmtCheck->execute();
    $count2 = $stmtCheck->fetchColumn();

    if ($count1 > 0 && $count2 > 0) {
        $success = $opension->Modifier($idpen, $libpen, $dateD, $dateF, $tarif, $numsire);

        if ($success) {
            $opension->updateCavaliers($idpen, $idcava3, $idcava4);
           header('Location: ../vue/vue.pension.php?success=1&message=Pension modifiée avec succès');
            exit();
        } else {
          header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de la modification de la pension');
            exit();
        }
    } else {
        //header('Location: ../vue/vue.pension.php?success=0&message=L\'ID du cavalier n\'existe pas');
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
