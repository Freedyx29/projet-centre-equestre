<?php

include '../class/class.pension.php';

$opension = new Pension();

if (isset($_POST['ajouter'])) {
    $libpen = $_POST['libpen'];
    $numsire = $_POST['numsire'];
    $success = $opension->PensionAjt($libpen, $numsire ) ? 1 : 0;
    header("Location: ../vue/vue.pension.php?success=$success");
}

if (isset($_POST['modifier'])) {
    $idpen = $_POST['idpen'];
    $libpen = $_POST['libpen'];
    $numsire = $_POST['numsire'];
    $success = $opension->Modifier($idpen, $libpen, $numsire) ? 1 : 0;
    header("Location: ../vue/vue.pension.php?success=$success");
}

if (isset($_POST['supprimer'])) {
    $idpen = $_POST['idpen'];
    $success = $opension->Supprimer($idpen) ? 1 : 0;
    header("Location: ../vue/vue.pension.php?success=$success");
}

?>
