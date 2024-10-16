<?php

include_once 'class.evenements.php';

$evenement = new Evenements();
$reqEvenements = $evenement->getAllEvenements();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Evenements</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0;">
<div class="container" style="width: 80%; max-width: 1200px; margin: 50px auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; color: #333;">CRUD Evenements</h2>

    <!-- Formulaire d'ajout d'événement -->
    <div class="form-popup" id="ajoutForm" style="background-color: #f9f9f9; padding: 20px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 20px;">
        <form action="traitement.evenements.php" method="POST" class="form-container">

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="titre" style="font-weight: bold; display: block;">Titre :</label>
                <input type="text" id="titre" name="titre" placeholder="Entrer le titre" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="commentaire" style="font-weight: bold; display: block;">Commentaire :</label>
                <input type="text" id="commentaire" name="commentaire" placeholder="Entrer le commentaire" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <button type="submit" name="ajouter" class="btn-primary" style="background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer;">Ajouter</button>
        </form>
    </div>

    <!-- Affichage des événements -->
    <?php
    $i = 0;
    foreach ($reqEvenements as $unEvenement) {
    ?>
        <form name="modifier" action="traitement.evenements.php" method="POST" class="entry" style="margin-bottom: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <div class="form-header" style="display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: bold;">ID Evenement : <?php echo $unEvenement['ideve']; ?></span>

                <div class="form-buttons">
                    <input type="hidden" name="ideve" value="<?php echo $unEvenement['ideve']; ?>">
                    <button class="btn-primary" type="submit" name="modifier" style="background-color: #007bff; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;">Modifier</button>
                    <button class="btn-danger" type="submit" name="supprimer" style="background-color: #dc3545; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;">Supprimer</button>
                </div>
            </div>

            <div class="form-group" style="margin-top: 15px;">
                <label for="titre-<?php echo $i; ?>" style="font-weight: bold;">Titre :</label>
                <input type="text" id="titre-<?php echo $i; ?>" name="titre" value="<?php echo $unEvenement['titre']; ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div class="form-group" style="margin-top: 10px;">
                <label for="commentaire-<?php echo $i; ?>" style="font-weight: bold;">Commentaire :</label>
                <input type="text" id="commentaire-<?php echo $i; ?>" name="commentaire" value="<?php echo $unEvenement['commentaire']; ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

        </form>
    <?php
        $i++;
    }
    ?>

    <div class="center-button" style="text-align: center;">
    </div>

</div>



</body>
</html>
