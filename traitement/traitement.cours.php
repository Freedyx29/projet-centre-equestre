<?php

include '../class/class.cours.php';

$ocours = new Cours();

if (isset($_POST['ajouter'])) {
    $libcours = $_POST['libcours'];
    $hdebut = $_POST['hdebut'];
    $hfin = $_POST['hfin'];
    $jour = $_POST['jour'];
    
    // Ajouter le cours
    $idcours = $ocours->CoursAjt($libcours, $hdebut, $hfin, $jour);
    
    if ($idcours) {
        // Ajouter les inscriptions
        if (isset($_POST['cavaliers']) && is_array($_POST['cavaliers'])) {
            foreach ($_POST['cavaliers'] as $idcava) {
                if (!empty($idcava)) {
                    $ocours->ajouterInscription($idcours, $idcava);
                }
            }
        }
        header("Location: ../vue/vue.cours.php?success=1&message=Cours et inscriptions ajoutés avec succès");
    } else {
        header("Location: ../vue/vue.cours.php?success=0&message=Erreur lors de l'ajout du cours");
    }
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
