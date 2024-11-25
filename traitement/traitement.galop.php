<?php

include '../class/class.galop.php';

$ogalop = new Galop();

if (isset($_POST['ajouter'])) {
    $libgalop = $_POST['libgalop'];
    $success = $ogalop->GalopAjt($libgalop) ? 1 : 0;
    header("Location: ../vue/vue.galop.php?success=1&message=Galop ajoutée avec succès");
}

if (isset($_POST['modifier'])) {
    $idgalop = $_POST['idgalop'];
    $libgalop = $_POST['libgalop'];
    $success = $ogalop->Modifier($idgalop, $libgalop) ? 1 : 0;
    header("Location: ../vue/vue.galop.php?success=1&message=Galop modifiée avec succès");
}

if (isset($_POST['supprimer'])) {
    $idgalop = $_POST['idgalop'];
    $success = $ogalop->Supprimer($idgalop) ? 1 : 0;
    header("Location: ../vue/vue.galop.php?success=1&message=Galop supprimée avec succès");
}

?>
