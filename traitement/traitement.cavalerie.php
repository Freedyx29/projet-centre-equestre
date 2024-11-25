<?php

include '../class/class.cavalerie.php';

$ocavalerie = new Cavalerie();

if (isset($_POST['ajouter'])) {
    $nomche = $_POST['nomche'];
    $datenache = $_POST['datenache'];
    $garrot = $_POST['garrot'];
    $photo = $_POST['photo'];
    $idrace = $_POST['idrace'];
    $idrobe = $_POST['idrobe'];
    $success = $ocavalerie->CavalerieAjt($nomche, $datenache, $garrot, $photo, $idrace, $idrobe) ? 1 : 0;
    header("Location: ../vue/vue.cavalerie.php?success=1&message=Cavalerie ajoutée avec succès");
}

if (isset($_POST['modifier'])) {
    $numsire = $_POST['numsire'];
    $nomche = $_POST['nomche'];
    $datenache = $_POST['datenache'];
    $garrot = $_POST['garrot'];
    $photo = $_POST['photo'];
    $idrace = $_POST['idrace'];
    $idrobe = $_POST['idrobe'];
    $success = $ocavalerie->Modifier($numsire, $nomche, $datenache, $garrot, $photo, $idrace, $idrobe) ? 1 : 0;
    header("Location: ../vue/vue.cavalerie.php?success=1&message=Cavalerie modifiée avec succès");
}

if (isset($_POST['supprimer'])) {
    $numsire = $_POST['numsire'];
    $success = $ocavalerie->Supprimer($numsire) ? 1 : 0;
    header("Location: ../vue/vue.cavalerie.php?success=1&message=Cavalerie supprimée avec succès");
}

?>
