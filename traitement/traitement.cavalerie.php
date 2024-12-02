<?php
include '../class/class.cavalerie.php';
$cavalerie = new Cavalerie();

if (isset($_POST['ajouter'])) {
    $nomche = $_POST['nomche'];
    $datenache = $_POST['datenache'];
    $garrot = $_POST['garrot'];
    $idrace = $_POST['idrace'];
    $idrobe = $_POST['idrobe'];

    $numsire = $cavalerie->CavalerieAjt($nomche, $datenache, $garrot, $idrace, $idrobe);
    if ($numsire) {
        // Traitement de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Vérifiez si le fichier est une image réelle ou une fausse image
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $cavalerie->ajouterPhoto($numsire, $target_file);
                } else {
                    echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
                }
            } else {
                echo "Le fichier n'est pas une image.";
            }
        }
        header("Location: ../vue/vue.cavalerie.php?success=1&message=Cavalerie ajoutée avec succès");
    } else {
        header("Location: ../vue/vue.cavalerie.php?success=0&message=Erreur lors de l'ajout de la cavalerie");
    }
}

if (isset($_POST['modifier'])) {
    $numsire = $_POST['numsire'];
    $nomche = $_POST['nomche'];
    $datenache = $_POST['datenache'];
    $garrot = $_POST['garrot'];
    $idrace = $_POST['idrace'];
    $idrobe = $_POST['idrobe'];

    // Suppression des photos sélectionnées
    if (isset($_POST['photos_to_delete']) && !empty($_POST['photos_to_delete'])) {
        foreach ($_POST['photos_to_delete'] as $photo_to_delete) {
            $cavalerie->supprimerPhoto($photo_to_delete);
        }
    }

    if ($cavalerie->Modifier($numsire, $nomche, $datenache, $garrot, $idrace, $idrobe)) {
        // Traitement de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["photo"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Vérifiez si le fichier est une image réelle ou une fausse image
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                    $cavalerie->ajouterPhoto($numsire, $target_file);
                } else {
                    echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
                }
            } else {
                echo "Le fichier n'est pas une image.";
            }
        }
        header("Location: ../vue/vue.cavalerie.php?success=1&message=Cavalerie modifiée avec succès");
    } else {
        header("Location: ../vue/vue.cavalerie.php?success=0&message=Erreur lors de la modification de la cavalerie");
    }
}

if (isset($_POST['supprimer'])) {
    $numsire = $_POST['numsire'];
    if ($cavalerie->Supprimer($numsire)) {
        header("Location: ../vue/vue.cavalerie.php?success=1&message=Cavalerie supprimée avec succès");
    } else {
        header("Location: ../vue/vue.cavalerie.php?success=0&message=Erreur lors de la suppression de la cavalerie");
    }
}
?>
