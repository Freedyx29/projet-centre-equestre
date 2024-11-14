<?php

include 'class.galop.php';
/*include '../includes/bdd.inc.php'; */

$ogalop = new Galop("", "");
$reqgalop = $ogalop->GalopAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Galop</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>CRUD Galop</h2>

    <?php
    $i = 0;
    foreach($reqgalop as $unreqgalop) {
        if ($reqgalop [$i]['supprime'] == '0') {
            $unreqgalop = new Galop($reqgalop[$i]["idgalop"],$reqgalop[$i]["libgalop"]);
    ?>
        <form name="modifier" action="traitement.galop.php" method="POST" class="entry">
            <div class="form-header">
            <span>ID Galop : <?php echo $unreqgalop->getidgalop(); ?></span>
                <div class="form-buttons">
                    <input type="hidden" name="idgalop" value="<?php echo $unreqgalop->getidgalop(); ?>">
                    <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                    <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                </div>
            </div>

            <div class="form-group">
                <label for="libgalop-<?php echo $i; ?>">libgalop :</label>
                <input type="text" id="libgalop-<?php echo $i; ?>" name="libgalop" value="<?php echo $unreqgalop->getlibgalop(); ?>"required>
            </div>

        </form>
    
    <?php
        }
        $i++;
    }
    ?>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm()">Ajouter un Galop</button>
    </div>

    <a id="formAnchor"></a>

    <div class="form-popup" id="ajoutForm">
        <form action="traitement.galop.php" method="POST" class="form-container">
            <h3>Ajouter un pays</h3>

            <div class="form-group">
                <label for="libgalop"><b>Libellé galop :</b></label>
                <input type="text" id="libgalop" name="libgalop" placeholder="Entrer le libellé galop" required>
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