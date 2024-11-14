<?php
include 'class.inscrit.php';

$oinscrit = new Inscrit();

if (isset($_POST['ajouter'])) {
    $idcours = $_POST['idcours'];
    $idcava = $_POST['idcava'];

    if (!empty($idcours) && !empty($idcava)) {
        $success = $oinscrit->InscritAjt($idcours, $idcava) ? 1 : 0;
        header("Location: vue.inscrit.php?success=$success");
    } else {
        echo "Les champs idcours et idcava ne peuvent pas être vides.";
    }
}


if (isset($_POST['modifier'])) {
    $idcours = $_POST['idcours'];
    $idcava = $_POST['idcava'];
    $new_idcours = $_POST['new_idcours'];
    $new_idcava = $_POST['new_idcava'];

    $oinscrit->setidcours($idcours);
    $oinscrit->setidcava($idcava);

    // Assurez-vous que la modification est réussie
    $success = $oinscrit->Modifier($new_idcours, $new_idcava) ? 1 : 0;
    header("Location: vue.inscrit.php?success=$success");
}



if (isset($_POST['supprimer'])) {
    $idcours = $_POST['idcours'];
    $idcava = $_POST['idcava'];
    $success = $oinscrit->Supprimer($idcours, $idcava) ? 1 : 0;
    header("Location: vue.inscrit.php?success=$success");
}
?>