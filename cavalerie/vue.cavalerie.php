<?php
include_once 'class.cavalerie.php';

$ocavalerie = new Cavalerie("", "", "", "", "", "");
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
    <script type="text/javascript" src="../js/script_cavalerie.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        
        .form-popup {
            display: none; /* Hide all forms by default */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
        }
        
    </style>
</head>
<body>

<div class="container">
    <h2>CRUD Cavalerie</h2>

    <div class="center-button">
        <button class="btn-primary" onclick="basculerFormulaire('ajoutForm')">Nouveau</button>
        <button class="btn-primary" id="modifierButton" onclick="basculerFormulaire('modifierForm')" disabled>Modifier une cavalerie</button>
        <button class="btn-danger" id="supprimerButton" onclick="basculerFormulaire('supprimerForm')" disabled>Supprimer une cavalerie</button>
    </div>

    <div class="form-popup" id="ajoutForm">
        <span class="close-btn" onclick="fermerFormulaire('ajoutForm')">&times;</span>
        <form action="traitement.cavalerie.php" method="POST" class="form-container">
            <h3>Ajouter une cavalerie</h3>

            <div class="form-group">
                <label for="nomche"><b>Nom cheval :</b></label>
                <input type="text" id="nomche" name="nomche" placeholder="Entrer le nom du cheval" required>
            </div>

            <div class="form-group">
                <label for="datenache"><b>Date de naissance :</b></label>
                <input type="date" id="datenache" name="datenache" placeholder="Entrer la date de naissance" required>
            </div>

            <div class="form-group">
                <label for="garrot"><b>Garrot :</b></label>
                <input type="text" id="garrot" name="garrot" placeholder="Entrer le garrot" required>
            </div>

            <div class="form-group">
                <label for="librace"><b>Race :</b></label>
                <input id="librace" name="librace" type="text" placeholder="Entrer la race" onkeyup="autocompletRace('')" required>
                <ul id="nom_list_race_id"></ul>
            </div>

            <div class="form-group">
                <label for="librobe"><b>Robe :</b></label>
                <input id="librobe" name="librobe" type="text" placeholder="Entrer la robe" onkeyup="autocompletRobe('')" required>
                <ul id="nom_list_robe_id"></ul>
            </div>

            <input type="hidden" id="id_race" name="idrace" value="">
            <input type="hidden" id="id_robe" name="idrobe" value="">

            <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
        </form>
    </div>

    <div class="form-popup" id="modifierForm">
        <span class="close-btn" onclick="fermerFormulaire('modifierForm')">&times;</span>
        <form action="traitement.cavalerie.php" method="POST" class="form-container" onsubmit="return validateForm()">
            <h3>Modifier une cavalerie</h3>

            <div class="form-group">
                <label for="modifier_numsire"><b>Numsire :</b></label>
                <input type="text" id="modifier_numsire" name="numsire" placeholder="Entrer le numsire" required>
            </div>

            <div class="form-group">
                <label for="modifier_nomche"><b>Nom cheval :</b></label>
                <input type="text" id="modifier_nomche" name="nomche" placeholder="Entrer le nom du cheval" required>
            </div>

            <div class="form-group">
                <label for="modifier_datenache"><b>Date de naissance :</b></label>
                <input type="date" id="modifier_datenache" name="datenache" placeholder="Entrer la date de naissance" required>
            </div>

            <div class="form-group">
                <label for="modifier_garrot"><b>Garrot :</b></label>
                <input type="text" id="modifier_garrot" name="garrot" placeholder="Entrer le garrot" required>
            </div>

            <div class="form-group">
                <label for="modifier_librace"><b>Race :</b></label>
                <input id="modifier_librace" name="librace" type="text" placeholder="Entrer la race" onkeyup="autocompletRace('modifier_')" required>
                <ul id="modifier_nom_list_race_id"></ul>
            </div>

            <div class="form-group">
                <label for="modifier_librobe"><b>Robe :</b></label>
                <input id="modifier_librobe" name="librobe" type="text" placeholder="Entrer la robe" onkeyup="autocompletRobe('modifier_')" required>
                <ul id="modifier_nom_list_robe_id"></ul>
            </div>

            <input type="hidden" id="modifier_id_race" name="idrace" value="">
            <input type="hidden" id="modifier_id_robe" name="idrobe" value="">

            <button type="submit" name="modifier" class="btn-primary">Mettre à jour</button>
        </form>
    </div>

    <div class="form-popup" id="supprimerForm">
        <span class="close-btn" onclick="fermerFormulaire('supprimerForm')">&times;</span>
        <form action="traitement.cavalerie.php" method="POST" class="form-container">
            <h3>Supprimer une cavalerie</h3>

            <div class="form-group">
                <label for="supprimer_numsire"><b>Numsire :</b></label>
                <input type="text" id="supprimer_numsire" name="numsire" placeholder="Entrer le numsire" required>
            </div>

            <button type="submit" name="supprimer" class="btn-danger">Supprimer</button>
        </form>
    </div>

    <h2>Liste des Cavaleries</h2>

<table id="cavalerieTable" class="display">
    <thead>
        <tr>
            <th>Sélectionner</th>
            <th>Numsire</th>
            <th>Nom cheval</th>
            <th>Date de naissance</th>
            <th>Garrot</th>
            <th>Race</th>
            <th>Robe</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($reqcavalerie as $unereqcavalerie) {
            if ($unereqcavalerie['supprime'] == '0') {
                $unereqcavalerieObj = new Cavalerie($unereqcavalerie["numsire"], $unereqcavalerie["nomche"], $unereqcavalerie["datenache"], $unereqcavalerie["garrot"], $unereqcavalerie["idrace"], $unereqcavalerie["idrobe"]);
        ?>
            <tr>
                <td><input type="checkbox" class="select-cavalerie" data-numsire="<?= htmlspecialchars($unereqcavalerieObj->getnumsire()) ?>" data-nomche="<?= htmlspecialchars($unereqcavalerieObj->getnomche()) ?>" data-datenache="<?= htmlspecialchars($unereqcavalerieObj->getdatenache()) ?>" data-garrot="<?= htmlspecialchars($unereqcavalerieObj->getgarrot()) ?>" data-race="<?= htmlspecialchars($ocavalerie->CavalerieRace($unereqcavalerieObj->getidrace())) ?>" data-robe="<?= htmlspecialchars($ocavalerie->CavalerieRobe($unereqcavalerieObj->getidrobe())) ?>"></td>
                <td><?= htmlspecialchars($unereqcavalerieObj->getnumsire()) ?></td>
                <td><?= htmlspecialchars($unereqcavalerieObj->getnomche()) ?></td>
                <td><?= htmlspecialchars($unereqcavalerieObj->getdatenache()) ?></td>
                <td><?= htmlspecialchars($unereqcavalerieObj->getgarrot()) ?></td>
                <td><?= htmlspecialchars($ocavalerie->CavalerieRace($unereqcavalerieObj->getidrace())) ?></td>
                <td><?= htmlspecialchars($ocavalerie->CavalerieRobe($unereqcavalerieObj->getidrobe())) ?></td>
            </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

</div>

</body>
</html>
