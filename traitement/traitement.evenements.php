<?php

include '../class/class.evenements.php';

$oevenements = new Evenements();

if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $commentaire = $_POST['commentaire'];
    $success = $oevenements->EvenementsAjt($titre, $commentaire) ? 1 : 0;
    header("Location: ../vue/vue.evenements.php?success=1&message=Evènement ajouté avec succès");
}

if (isset($_POST['modifier'])) {
    $ideve = $_POST['ideve'];
    $titre = $_POST['titre'];
    $commentaire = $_POST['commentaire'];
    $success = $oevenements->Modifier($ideve, $titre, $commentaire) ? 1 : 0;
    header("Location: ../vue/vue.evenements.php?success=1&message=Evènement modifié avec succès");
}

if (isset($_POST['supprimer'])) {
    $ideve = $_POST['ideve'];
    $success = $oevenements->Supprimer($ideve) ? 1 : 0;
    header("Location: ../vue/vue.evenements.php?success=1&message=Evènement supprimé avec succès");
}

?>
