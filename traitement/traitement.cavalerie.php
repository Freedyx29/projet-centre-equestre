<?php
include '../class/class.cavalerie.php';

$ocavalerie = new Cavalerie();

if (isset($_POST['ajouter'])) {
    $nomche = $_POST['nomche'];
    $datenache = $_POST['datenache'];
    $garrot = $_POST['garrot'];
    $idrace = $_POST['idrace'];
    $idrobe = $_POST['idrobe'];

    if (!empty($idrace) && !empty($idrobe)) {
        $success = $ocavalerie->CavalerieAjt($nomche, $datenache, $garrot, $idrace, $idrobe) ? 1 : 0;
        header("Location: ../vue/vue.cavalerie.php?success=$success");
    } else {
        echo "Les champs idrace et idrobe ne peuvent pas être vides.";
    }
}

if (isset($_POST['modifier'])) {
    $numsire = $_POST['numsire'];
    $nomche = $_POST['nomche'];
    $datenache = $_POST['datenache'];
    $garrot = $_POST['garrot'];
    $idrace = $_POST['idrace'];
    $idrobe = $_POST['idrobe'];

    // Si idrace ou idrobe est vide, récupérer les valeurs actuelles
    if (empty($idrace) || empty($idrobe)) {
        $currentCavalerie = $ocavalerie->getCavalerieByNumsire($numsire);
        if ($currentCavalerie) {
            if (empty($idrace)) {
                $idrace = $currentCavalerie['idrace'];
            }
            if (empty($idrobe)) {
                $idrobe = $currentCavalerie['idrobe'];
            }
        }
    }

    $success = $ocavalerie->Modifier($numsire, $nomche, $datenache, $garrot, $idrace, $idrobe) ? 1 : 0;
    header("Location: ../vue/vue.cavalerie.php?success=$success");
}

if (isset($_POST['supprimer'])) {
    $numsire = $_POST['numsire'];
    $success = $ocavalerie->Supprimer($numsire) ? 1 : 0;
    header("Location: ../vue/vue.cavalerie.php?success=$success");
}


?>
