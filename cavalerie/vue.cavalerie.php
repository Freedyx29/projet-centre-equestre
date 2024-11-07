<?php

include_once 'class.cavalerie.php';

$ocavalerie = new Cavalerie("","", "", "", "", "");
$reqcavalerie = $ocavalerie->CavalerieALL();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Cavalerie</title>
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/script_cavalerie.race.js"></script>
    <script type="text/javascript" src="../js/script_cavalerie.robe.js"></script>

</head>
<body>
<div class="container">
    <h2>CRUD Cavalerie</h2>

    <?php
    $i = 0;
    foreach($reqcavalerie as $unereqcavalerie) {
        if ($reqcavalerie [$i]['supprime'] == '0') {
            $unereqcavalerie = new Cavalerie($reqcavalerie[$i]["numsire"],$reqcavalerie[$i]["nomche"],
                                            $reqcavalerie[$i]["datenache"],$reqcavalerie[$i]["garrot"],
                                             $reqcavalerie[$i]["idrace"],$reqcavalerie[$i]["idrobe"]);
                                               
    ?>
        <form name="modifier" action="traitement.cavalerie.php" method="POST" class="entry">
            <div class="form-header">
            <span>ID Cavalerie : <?php echo $unereqcavalerie->getnumsire(); ?></span>

                <div class="form-buttons">
                    <input type="hidden" name="numsire" value="<?php echo $unereqcavalerie->getnumsire(); ?>">
                    <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                    <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                </div>

            </div>

                <div class="form-group">
                    <label for="nomche-<?php echo $i; ?>">Nom cheval :</label>
                    <input type="text" id="nomche-<?php echo $i; ?>" name="nomche" value="<?php echo $unereqcavalerie->getnomche(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="datenache-<?php echo $i; ?>">Date de naissance du cheval :</label>
                    <input type="text" id="datenache-<?php echo $i; ?>" name="datenache" value="<?php echo $unereqcavalerie->getdatenache(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="garrot-<?php echo $i; ?>">Garrot :</label>
                    <input type="text" id="garrot-<?php echo $i; ?>" name="garrot" value="<?php echo $unereqcavalerie->getgarrot(); ?>"required>
                </div>


                <!-- Autocomplet de Race -->
                <div class="form-group">
                    <label for="librace<?php echo $i; ?>">Libellé race :</label>
                    <input id="librace<?php echo $i; ?>" name="librace" type="text" value="<?php echo $ocavalerie->CavalerieRace($unereqcavalerie->getidrace()); ?>" onkeyup="autocompletRace(<?php echo $i; ?>)"required>
                    <ul id="nom_list_race_id<?php echo $i; ?>"></ul>
                </div>

                <input type="hidden" id="id_race<?php echo $i; ?>" name="idrace" value="<?php echo $unereqcavalerie->getidrace(); ?>">


                <!-- Autocomplet de Robe -->
                <div class="form-group">
                    <label for="librobe<?php echo $i; ?>">Libellé galop :</label>
                    <input id="librobe<?php echo $i; ?>" name="librobe" type="text" value="<?php echo $ocavalerie->CavalerieRobe($unereqcavalerie->getidrobe()); ?>" onkeyup="autocompletRobe(<?php echo $i; ?>)"required>
                    <ul id="nom_list_robe_id<?php echo $i; ?>"></ul>
                </div>

                <input type="hidden" id="id_robe<?php echo $i; ?>" name="idrobe" value="<?php echo $unereqcavalerie->getidrobe(); ?>">

        </form>
    
    <?php
        }
        $i++;
    }
    ?>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm()">Ajouter une cavalerie</button>
    </div>

    <a id="formAnchor"></a>

    <div class="form-popup" id="ajoutForm">
        <form action="traitement.cavalerie.php" method="POST" class="form-container">
            <h3>Ajouter une cavalerie</h3>

            <div class="form-group">
                <label for="nomche"><b>Nom cheval :</b></label>
                <input type="text" id="nomche" name="nomche" placeholder="Entrer le nom du cheval" required>
            </div>

            <div class="form-group">
                <label for="datenache"><b>Date de naissance du cheval :</b></label>
                <input type="text" id="datenache" name="datenache" placeholder="Entrer le date de naissance" required>
            </div>

            <div class="form-group">
                <label for="garrot"><b>Garrot :</b></label>
                <input type="text" id="garrot" name="garrot" placeholder="Entrer le garrot" required>
            </div>


            <!-- Autocomplet de Race -->
            <div class="form-group">
                <label for="librace"><b>Libellé race :</b></label>
                <input id="librace" name="librace" type="text" placeholder="Entrer le libellé race"  onkeyup="autocompletRaceajout()" required>
                <ul id="nom_list_race_id"</ul>
            </div>

            <input type="hidden" id="id_race" name="idrace" value="<?php echo $unereqcavalerie->getidrace(); ?>">


            <!-- Autocomplet de Robe -->
            <div class="form-group">
                <label for="librobe"><b>Libellé robe :</b></label>
                <input id="librobe" name="librobe" type="text" placeholder="Entrer le libellé robe"  onkeyup="autocompletRobeajout()" required>
                <ul id="nom_list_robe_id"</ul>
            </div>

            <input type="hidden" id="id_robe" name="idrobe" value="<?php echo $unereqcavalerie->getidrobe(); ?>">


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