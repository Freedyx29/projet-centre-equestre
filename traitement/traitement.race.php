<?php

include '../class/class.race.php';

$orace = new Race();

if (isset($_POST['ajouter'])) {
    $librace = $_POST['librace'];
    $success = $orace->RaceAjt($librace) ? 1 : 0;
    header("Location: ../vue/vue.race.php?success=1&message=Race ajoutée avec succès");
    exit();
}

if (isset($_POST['modifier'])) {
    $idrace = $_POST['idrace'];
    $librace = $_POST['librace'];
    $success = $orace->Modifier($idrace, $librace) ? 1 : 0;
    header("Location: ../vue/vue.race.php?success=1&message=Race modifiée avec succès");
    exit();
}

if (isset($_POST['supprimer'])) {
    $idrace = $_POST['idrace'];
    $success = $orace->Supprimer($idrace) ? 1 : 0;
    header("Location: ../vue/vue.race.php?success=1&message=Race supprimée avec succès");
    exit();
}

?>
