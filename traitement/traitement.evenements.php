<?php
include '../class/class.evenements.php';
$oevenements = new Evenements();

if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $commentaire = $_POST['commentaire'];
    $ideve = $oevenements->EvenementsAjt($titre, $commentaire);
    if ($ideve) {
        // Traitement de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Vérifiez si le fichier est une image réelle ou une fausse image
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $oevenements->ajouterPhotoEve($ideve, $target_file);
                } else {
                    echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
                }
            } else {
                echo "Le fichier n'est pas une image.";
            }
        }
        header("Location: ../vue/vue.evenements.php?success=1&message=Evènement ajouté avec succès");
    } else {
        header("Location: ../vue/vue.evenements.php?success=0&message=Erreur lors de l'ajout de l'évènement");
    }
}

if (isset($_POST['modifier'])) {
    $ideve = $_POST['ideve'];
    $titre = $_POST['titre'];
    $commentaire = $_POST['commentaire'];
    // Suppression des photos sélectionnées
    if (isset($_POST['photos_to_delete']) && !empty($_POST['photos_to_delete'])) {
        foreach ($_POST['photos_to_delete'] as $photo_to_delete) {
            $oevenements->supprimerPhoto($photo_to_delete);
        }
    }
    if ($oevenements->Modifier($ideve, $titre, $commentaire)) {
        // Traitement de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Vérifiez si le fichier est une image réelle ou une fausse image
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $oevenements->ajouterPhotoEve($ideve, $target_file);
                } else {
                    echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
                }
            } else {
                echo "Le fichier n'est pas une image.";
            }
        }
        header("Location: ../vue/vue.evenements.php?success=1&message=Evènement modifié avec succès");
    } else {
        header("Location: ../vue/vue.evenements.php?success=0&message=Erreur lors de la modification de l'évènement");
    }
}

if (isset($_POST['supprimer'])) {
    $ideve = $_POST['ideve'];
    if ($oevenements->Supprimer($ideve)) {
        header("Location: ../vue/vue.evenements.php?success=1&message=Evènement supprimé avec succès");
    } else {
        header("Location: ../vue/vue.evenements.php?success=0&message=Erreur lors de la suppression de l'évènement");
    }
}
?>
