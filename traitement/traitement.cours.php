<?php

include '../class/class.cours.php';

$ocours = new Cours();

if (isset($_POST['ajouter'])) {
    $libcours = $_POST['libcours'];
    $hdebut = $_POST['hdebut'];
    $hfin = $_POST['hfin'];
    $jour = $_POST['jour'];
    $success = $ocours->CoursAjt($libcours, $hdebut, $hfin, $jour) ? 1 : 0;
    header("Location: ../vue/vue.cours.php?success=1&message=Cours ajouté avec succès");
    exit();
}

if (isset($_POST['modifier'])) {
    $idcours = $_POST['idcours'];
    $libcours = $_POST['libcours'];
    $hdebut = $_POST['hdebut'];
    $hfin = $_POST['hfin'];
    $jour = $_POST['jour'];
    $success = $ocours->Modifier($idcours, $libcours, $hdebut, $hfin, $jour) ? 1 : 0;
    header("Location: ../vue/vue.cours.php?success=1&message=Cours modifié avec succès");
    exit();
}

if (isset($_POST['supprimer'])) {
    $idcours = $_POST['idcours'];
    $success = $ocours->Supprimer($idcours) ? 1 : 0;
    header("Location: ../vue/vue.cours.php?success=1&message=Cours supprimé avec succès");
    exit();
}

?>
