<?php

include '../class/class.prend.php';

$oprend = new Prend();

if (isset($_POST['ajouter'])) {
    $refidcava = $_POST['idcava'];
    $refidpen = $_POST['idpen'];
    $success = $oprend->PrendAjt($refidcava, $refidpen) ? 1 : 0;
    header("Location: ../vue/vue.prend.php?success=1&message=Prêt ajouté avec succès");
}

if (isset($_POST['modifier'])) {
    $id_cava_first = $_POST['id_cava_first'];
    $id_pen_first = $_POST['id_pen_first'];
    $refidcava = $_POST['idcava'];
    $refidpen = $_POST['idpen'];
    $success = $oprend->Modifier($id_cava_first, $id_pen_first, $refidcava, $refidpen) ? 1 : 0;
    header("Location: ../vue/vue.prend.php?success=1&message=Prêt modifié avec succès");
}

if (isset($_POST['supprimer'])) {
    $refidcava = $_POST['refidcava'];
    $refidpen = $_POST['refidpen'];
    $success = $oprend->Supprimer($refidcava, $refidpen) ? 1 : 0;
    header("Location: ../vue/vue.prend.php?success=1&message=Prêt supprimé avec succès");
}

?>
