<?php

include '../class/class.inscrit.php';

$oinscrit = new Inscrit();

if (isset($_POST['ajouter'])) {
    $refidcours = $_POST['idcours'];
    $refidcava = $_POST['idcava'];
    $success = $oinscrit->InscritAjt($refidcours, $refidcava) ? 1 : 0;
    header("Location: ../vue/vue.inscrit.php?success=1&message=Inscription ajoutée avec succès");
}

if (isset($_POST['modifier'])) {
    $id_cours_first = $_POST['id_cours_first'];
    $id_cava_first = $_POST['id_cava_first'];
    $refidcours = $_POST['idcours'];
    $refidcava = $_POST['idcava'];
    $success = $oinscrit->Modifier($id_cours_first, $id_cava_first, $refidcours, $refidcava) ? 1 : 0;
    header("Location: ../vue/vue.inscrit.php?success=1&message=Inscription modifiée avec succès");
}

if (isset($_POST['supprimer'])) {
    $refidcours = $_POST['refidcours'];
    $refidcava = $_POST['refidcava'];
    $success = $oinscrit->Supprimer($refidcours, $refidcava) ? 1 : 0;
    header("Location: ../vue/vue.inscrit.php?success=1&message=Inscription supprimée avec succès");
}

?>
