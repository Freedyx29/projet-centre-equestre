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

<?php

include_once '../class/class.pension.php';

$opension = new Pension("","", "");
$reqpension = $opension->PensionALL();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pension</title>
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/script_pension.js"></script>

</head>
<body>
<div class="container">
    <h2>CRUD Pension</h2>

    <?php
    $i = 0;
    foreach($reqpension as $unereqpension) {
        if ($reqpension [$i]['supprime'] == '0') {
            $unereqpension = new Pension($reqpension[$i]["idpen"],$reqpension[$i]["libpen"],$reqpension[$i]["numsire"]);
    ?>
        <form name="modifier" action="../traitement/traitement.pension.php" method="POST" class="entry">
            <div class="form-header">
            <span>ID Pension : <?php echo $unereqpension->getidpen(); ?></span>

                <div class="form-buttons">
                    <input type="hidden" name="idpen" value="<?php echo $unereqpension->getidpen(); ?>">
                    <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                    <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                </div>

            </div>

                <div class="form-group">
                    <label for="libpen-<?php echo $i; ?>">Libellé de la pension :</label>
                    <input type="text" id="libpen-<?php echo $i; ?>" name="libpen" value="<?php echo $unereqpension->getlibpen(); ?>"required>
                </div>


                <div class="form-group">
                    <label for="nomche<?php echo $i; ?>">Nom du cheval :</label>
                    <input id="nomche<?php echo $i; ?>" name="nomche" type="text" value="<?php echo $opension->PensionNumsire($unereqpension->getnumsire()); ?>" onkeyup="autocompletPension(<?php echo $i; ?>)"required>
                    <ul id="nom_list_pension_id<?php echo $i; ?>"></ul>
                </div>

                <input type="hidden" id="num_sire<?php echo $i; ?>" name="numsire" value="<?php echo $unereqpension->getnumsire(); ?>">

        </form>
    
    <?php
        }
        $i++;
    }
    ?>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm()">Ajouter une Pension</button>
    </div>

    <a id="formAnchor"></a>

    <div class="form-popup" id="ajoutForm">
        <form action="../traitement/traitement.pension.php" method="POST" class="form-container">
            <h3>Ajouter une Pension</h3>

            <div class="form-group">
                <label for="libpen"><b>Libellé de la pension :</b></label>
                <input type="text" id="libpen" name="libpen" placeholder="Entrer la libellé de la pension" required>
            </div>


            <div class="form-group">
                <label for="nomche"><b>Nom du cheval :</b></label>
                <input id="nomche" name="nomche" type="text" placeholder="Entrer le nom du cheval"  onkeyup="autocompletPensionajout()" required>
                <ul id="nom_list_pension_id"></ul>
            </div>

            <input type="hidden" id="num_sire" name="numsire">


            <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
        </form>
    </div>
</div>
</body>
</html>
