<?php

include '../class/class.robe.php';
/*include '../includes/bdd.inc.php'; */

$orobe = new Robe("", "");
$reqrobe = $orobe->RobeALL();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Robe</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>CRUD Robe</h2>

    <?php
    $i = 0;
    foreach($reqrobe as $unreqrobe) {
        if ($reqrobe [$i]['supprime'] == '0') {
            $unreqrobe = new Robe($reqrobe[$i]["idrobe"],$reqrobe[$i]["librobe"]);
    ?>
        <form name="modifier" action="../traitement/traitement.robe.php" method="POST" class="entry">
            <div class="form-header">
            <span>ID Race : <?php echo $unreqrobe->getidrobe(); ?></span>
                <div class="form-buttons">
                    <input type="hidden" name="idrobe" value="<?php echo $unreqrobe->getidrobe(); ?>">
                    <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                    <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                </div>
            </div>

            <div class="form-group">
                <label for="librobe-<?php echo $i; ?>">Libellé de la robe :</label>
                <input type="text" id="librobe-<?php echo $i; ?>" name="librobe" value="<?php echo $unreqrobe->getlibrobe(); ?>"required>
            </div>

        </form>
    
    <?php
        }
        $i++;
    }
    ?>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm()">Ajouter une robe</button>
    </div>

    <a id="formAnchor"></a>

    <div class="form-popup" id="ajoutForm">
        <form action="../traitement/traitement.robe.php" method="POST" class="form-container">
            <h3>Ajouter un cours</h3>

            <div class="form-group">
                <label for="librobe"><b>Libellé de la robe :</b></label>
                <input type="text" id="librobe" name="librobe" placeholder="Entrer le libellé de la robe" required>
            </div>

            <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
        </form>
    </div>
</div>

<script>
    function toggleForm() {
        var form = document.getElementById("ajoutForm");
        form.classList.toggle("show");

        if (form.classList.contains("show")) {
            document.getElementById("formAnchor").scrollIntoView({ behavior: 'smooth' });
        }
    }

    function showAlert(message) {
        alert(message);
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === '1') {
        showAlert("update des données réussie !");
    } else if (urlParams.get('success') === '0') {
        showAlert("Erreur lors de la suppression.");
    }
</script>
</body>
</html>
