<?php

include '../class/class.cavaliers.php';

$ocavaliers = new Cavaliers();

if (isset($_POST['ajouter'])) {
    $nomcava = $_POST['nomcava'];
    $prenomcava = $_POST['prenomcava'];
    $datenacava = $_POST['datenacava'];
    $numlic = $_POST['numlic'];
    $nomresp = $_POST['nomresp'];
    $prenomresp = $_POST['prenomresp'];
    $rueresp = $_POST['rueresp'];
    $vilresp = $_POST['vilresp'];
    $cpresp = $_POST['cpresp'];
    $telresp = $_POST['telresp'];
    $emailresp = $_POST['emailresp'];
    $password = $_POST['password'];
    $assurance = $_POST['assurance'];
    $idgalop = $_POST['idgalop'];
    $success = $ocavaliers->CavaliersAjt($nomcava, $prenomcava, $datenacava, $numlic,$nomresp, $prenomresp, $rueresp, $vilresp, $cpresp, $telresp,
                                        $emailresp, $password, $assurance, $idgalop ) ? 1 : 0;
    header("Location: ../vue/vue.cavaliers.php?success=1&message=Cavalier ajouté avec succès");
}

if (isset($_POST['modifier'])) {
    $idcava = $_POST['idcava'];
    $nomcava = $_POST['nomcava'];
    $prenomcava = $_POST['prenomcava'];
    $datenacava = $_POST['datenacava'];
    $numlic = $_POST['numlic'];
    $nomresp = $_POST['nomresp'];
    $prenomresp = $_POST['prenomresp'];
    $rueresp = $_POST['rueresp'];
    $vilresp = $_POST['vilresp'];
    $cpresp = $_POST['cpresp'];
    $telresp = $_POST['telresp'];
    $emailresp = $_POST['emailresp'];
    $password = $_POST['password'];
    $assurance = $_POST['assurance'];
    $idgalop = $_POST['idgalop'];
    $success = $ocavaliers->Modifier($idcava, $nomcava, $prenomcava, $datenacava, $numlic,
    $nomresp, $prenomresp, $rueresp, $vilresp, $cpresp, $telresp,
    $emailresp, $password, $assurance, $idgalop) ? 1 : 0;
    header("Location: ../vue/vue.cavaliers.php?success=1&message=Cavalier modifié avec succès");
}

if (isset($_POST['supprimer'])) {
    $idcava = $_POST['idcava'];
    $success = $ocavaliers->Supprimer($idcava) ? 1 : 0;
    header("Location: ../vue/vue.cavaliers.php?success=1&message=Cavalier supprimé avec succès");
}

?>
