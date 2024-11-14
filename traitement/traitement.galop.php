<?php
include 'class.galop.php';

$oGalop = new Galop();

if (isset($_POST['ajouter'])) {
    $libgalop = $_POST['libgalop'];
    $success = $oGalop->galopAjout($libgalop) ? 1 : 0;
    header("Location: vue.galop.php?success=$success");
    exit();
}

if (isset($_POST['modifier'])) {
    $idgalop = $_POST['idgalop'];
    $libgalop = $_POST['libgalop'];
    $success = $oGalop->Modifier($idgalop, $libgalop) ? 1 : 0;
    header("Location: vue.galop.php?success=$success");
    exit();
}

if (isset($_POST['supprimer'])) {
    $idgalop = $_POST['idgalop'];
    $success = $oGalop->Supprimer($idgalop) ? 1 : 0;
    header("Location: vue.galop.php?success=$success");
    exit();
}
?>