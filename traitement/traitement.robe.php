<?php

include '../class/class.robe.php';

$orobe = new Robe();

if (isset($_POST['ajouter'])) {
    $librobe = $_POST['librobe'];
    $success = $orobe->RobeAjt($librobe) ? 1 : 0;
    header("Location: ../vue/vue.robe.php?success=1&message=Robe ajoutée avec succès");
    exit();
}

if (isset($_POST['modifier'])) {
    $idrobe = $_POST['idrobe'];
    $librobe = $_POST['librobe'];
    $success = $orobe->Modifier($idrobe, $librobe) ? 1 : 0;
    header("Location: ../vue/vue.robe.php?success=1&message=Robe modifiée avec succès");
    exit();
}

if (isset($_POST['supprimer'])) {
    $idrobe = $_POST['idrobe'];
    $success = $orobe->Supprimer($idrobe) ? 1 : 0;
    header("Location: ../vue/vue.robe.php?success=1&message=Robe supprimée avec succès");
    exit();
}

?>
