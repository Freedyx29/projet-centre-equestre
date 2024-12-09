<?php

include '../class/class.pension.php';

$opension = new Pension();

if (isset($_POST['ajouter'])) {
    $libpen = $_POST['libpen'];
    $dateD = $_POST['dateD'];
    $dateF = $_POST['dateF'];
    $tarif = $_POST['tarif'];
    $numsire = $_POST['numsire'];
    $idcava = $_POST['idcava'];

    $idpen = $opension->PensionAjt($libpen, $dateD, $dateF, $tarif, $numsire);

    if ($idpen) {
        $con = connexionPDO();
        $data = [
            ':refidcava' => $idcava,
            ':refidpen' => $idpen
        ];

        $sql = "INSERT INTO prend (refidcava, refidpen) VALUES (:refidcava, :refidpen);";
        $stmn = $con->prepare($sql);

        if ($stmn->execute($data)) {
            header('Location: ../vue/vue.pension.php?success=1&message=Pension ajoutée avec succès');
            exit();
        } else {
            header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de l\'ajout de la pension');
            exit();
        }
    } else {
        header('Location: ../vue/vue.pension.php?success=0&message=Erreur lors de l\'ajout de la pension');
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
    $success = $opension->Modifier($idpen, $libpen, $dateD, $dateF, $tarif, $numsire) ? 1 : 0;
    header('Location: ../vue/vue.pension.php?success=1&message=Pension modifiée avec succès');
    exit();
}

if (isset($_POST['supprimer'])) {
    $idpen = $_POST['idpen'];
    $success = $opension->Supprimer($idpen) ? 1 : 0;
    header('Location: ../vue/vue.pension.php?success=1&message=Pension supprimée avec succès');
    exit();
}

?>
