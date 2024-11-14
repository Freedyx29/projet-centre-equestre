<?php 

include 'class.race.php';

$oRace = new Race();

if (isset($_POST['ajouter'])) {
    $librace = $_POST['librace'];
    $success = $oRace->raceAjout($librace) ? 1 : 0;
    header("Location: vue.race.php?success=$success");
    exit();
}

if (isset($_POST['modifier'])) {
    $idrace = $_POST['idrace'];
    $librace = $_POST['librace'];
    $success = $oRace->Modifier($idrace, $librace) ? 1 : 0;
    header("Location: vue.race.php?success=$success");
    exit();
}

if (isset($_POST['supprimer'])) {
    $idrace = $_POST['idrace'];
    $success = $oRace->Supprimer($idrace) ? 1 : 0;
    header("Location: vue.race.php?success=$success");
    exit();
}

?>
