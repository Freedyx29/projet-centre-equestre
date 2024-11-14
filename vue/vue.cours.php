<?php

include '../class/class.cours.php';
/*include '../includes/bdd.inc.php'; */

$ocours = new Cours("", "", "", "");
$reqcours = $ocours->CoursAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Cours</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>CRUD Cours</h2>

    <?php
    $i = 0;
    foreach($reqcours as $unreqcours) {
        if ($reqcours [$i]['supprime'] == '0') {
            $unreqcours = new Cours($reqcours[$i]["idcours"],$reqcours[$i]["libcours"],$reqcours[$i]["hdebut"],$reqcours[$i]["hfin"]);
    ?>
        <form name="modifier" action="traitement.cours.php" method="POST" class="entry">
            <div class="form-header">
            <span>ID Cours : <?php echo $unreqcours->getidcours(); ?></span>
                <div class="form-buttons">
                    <input type="hidden" name="idcours" value="<?php echo $unreqcours->getidcours(); ?>">
                    <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                    <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                </div>
            </div>

            <div class="form-group">
                <label for="libcours-<?php echo $i; ?>">Libellé du cours :</label>
                <input type="text" id="libcours-<?php echo $i; ?>" name="libcours" value="<?php echo $unreqcours->getlibcours(); ?>"required>
            </div>

            <div class="form-group">
                <label for="hdebut-<?php echo $i; ?>">Heure début :</label>
                <input type="time" id="hdebut-<?php echo $i; ?>" name="hdebut" value="<?php echo $unreqcours->gethdebut(); ?>"required>
            </div>

            <div class="form-group">
                <label for="hfin-<?php echo $i; ?>">Heure fin :</label>
                <input type="time" id="hfin-<?php echo $i; ?>" name="hfin" value="<?php echo $unreqcours->gethfin(); ?>"required>
            </div>

        </form>
    
    <?php
        }
        $i++;
    }
    ?>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm()">Ajouter un cours</button>
    </div>

    <a id="formAnchor"></a>

    <div class="form-popup" id="ajoutForm">
        <form action="traitement.cours.php" method="POST" class="form-container">
            <h3>Ajouter un cours</h3>

            <div class="form-group">
                <label for="libcours"><b>Libellé cours :</b></label>
                <input type="text" id="libcours" name="libcours" placeholder="Entrer le libellé cours" required>
            </div>

            <div class="form-group">
                <label for="hdebut"><b>Heure début :</b></label>
                <input type="time" id="hdebut" name="hdebut" placeholder="Entrer l'heure de début" required>
            </div>

            <div class="form-group">
                <label for="hfin"><b>Heure fin :</b></label>
                <input type="time" id="hfin" name="hfin" placeholder="Entrer l'heure de fin" required>
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
