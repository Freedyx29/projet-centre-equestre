<?php

include 'class.evenements.php';

$evenement = new Evenements();

if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $commentaire = $_POST['commentaire'];
    $success = $evenement->ajouterEvenement($titre, $commentaire) ? 1 : 0;
    header("Location: vue.evenements.php?success=$success");
}

if (isset($_POST['modifier'])) {
    $ideve = $_POST['ideve'];
    $titre = $_POST['titre'];
    $commentaire = $_POST['commentaire'];
    $success = $evenement->modifierEvenement($ideve, $titre, $commentaire) ? 1 : 0;
    header("Location: vue.evenements.php?success=$success");
}

if (isset($_POST['supprimer'])) {
    $ideve = $_POST['ideve'];
    $success = $evenement->supprimerEvenement($ideve) ? 1 : 0;
    header("Location: vue.evenements.php?success=$success");
}

?>
