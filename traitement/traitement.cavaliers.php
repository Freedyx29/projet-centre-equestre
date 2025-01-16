<?php
session_start();
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

    // Stocker le mot de passe en clair dans la session
    $_SESSION['clear_password'][$emailresp] = $password;

    // Message de débogage
    error_log("Mot de passe en clair stocké pour l'email: $emailresp");

    $success = $ocavaliers->CavaliersAjt($nomcava, $prenomcava, $datenacava, $numlic, $nomresp, $prenomresp, $rueresp, $vilresp, $cpresp, $telresp, $emailresp, $password, $assurance, $idgalop) ? 1 : 0;
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

    // Stocker le mot de passe en clair dans la session
    $_SESSION['clear_password'][$emailresp] = $password;

    // Message de débogage
    error_log("Mot de passe en clair stocké pour l'email: $emailresp");

    $success = $ocavaliers->Modifier($idcava, $nomcava, $prenomcava, $datenacava, $numlic, $nomresp, $prenomresp, $rueresp, $vilresp, $cpresp, $telresp, $emailresp, $password, $assurance, $idgalop) ? 1 : 0;
    header("Location: ../vue/vue.cavaliers.php?success=1&message=Cavalier modifié avec succès");
}

if (isset($_POST['supprimer'])) {
    $idcava = $_POST['idcava'];
    $success = $ocavaliers->Supprimer($idcava) ? 1 : 0;
    header("Location: ../vue/vue.cavaliers.php?success=1&message=Cavalier supprimé avec succès");
}
?>
