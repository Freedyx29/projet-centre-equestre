<?php

include '../class/class.race.php';
/*include '../includes/bdd.inc.php'; */

$orace = new Race("", "");
$reqrace = $orace->RaceALL();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Race</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>CRUD Race</h2>

    <?php
    $i = 0;
    foreach($reqrace as $unreqrace) {
        if ($reqrace [$i]['supprime'] == '0') {
            $unreqrace = new Race($reqrace[$i]["idrace"],$reqrace[$i]["librace"]);
    ?>
        <form name="modifier" action="traitement.race.php" method="POST" class="entry">
            <div class="form-header">
            <span>ID Race : <?php echo $unreqrace->getidrace(); ?></span>
                <div class="form-buttons">
                    <input type="hidden" name="idrace" value="<?php echo $unreqrace->getidrace(); ?>">
                    <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                    <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                </div>
            </div>

            <div class="form-group">
                <label for="librace-<?php echo $i; ?>">Libellé de la race :</label>
                <input type="text" id="librace-<?php echo $i; ?>" name="librace" value="<?php echo $unreqrace->getlibrace(); ?>"required>
            </div>

        </form>
    
    <?php
        }
        $i++;
    }
    ?>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm()">Ajouter une race</button>
    </div>

    <a id="formAnchor"></a>

    <div class="form-popup" id="ajoutForm">
        <form action="traitement.race.php" method="POST" class="form-container">
            <h3>Ajouter un cours</h3>

            <div class="form-group">
                <label for="librace"><b>Libellé de la race :</b></label>
                <input type="text" id="librace" name="librace" placeholder="Entrer le libellé de la race" required>
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
