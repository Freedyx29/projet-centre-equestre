<?php
require_once '../class/class.cavalerie.php';
$cavalerie = new Cavalerie();
$cavalerieList = $cavalerie->CavalerieALL();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Cavaleries</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../js/script_cavalerie.race.js"></script>
    <script src="../js/script_cavalerie.robe.js"></script>
    <script src="../js/script_cavalerie.js"></script>

    <style>
        .form-popup {
            display: none;
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
    <h2>CRUD Cavaleries</h2>

    <div class="center-button">
        <button class="btn-primary" onclick="basculerFormulaire('ajoutForm')">Ajouter une cavalerie</button>
        <button class="btn-primary" id="modifierButton" onclick="basculerFormulaire('modifierForm')" disabled>Modifier une cavalerie</button>
        <button class="btn-danger" id="supprimerButton" onclick="basculerFormulaire('supprimerForm')" disabled>Supprimer une cavalerie</button>
    </div>

<!-- Formulaire d'ajout -->
<div class="form-popup" id="ajoutForm">
    <span class="close-btn" onclick="fermerFormulaire('ajoutForm')">&times;</span>
    <form action="../traitement/traitement.cavalerie.php" method="POST" class="form-container">
        <h3>Ajouter une cavalerie</h3>
        <div class="form-group">
            <label for="nomche"><b>Nom du Cheval :</b></label>
            <input type="text" id="nomche" name="nomche" placeholder="Entrer le nom du cheval" required>
        </div>
        <div class="form-group">
            <label for="datenache"><b>Date de Naissance :</b></label>
            <input type="date" id="datenache" name="datenache" required>
        </div>
        <div class="form-group">
            <label for="garrot"><b>Garrot :</b></label>
            <input type="number" id="garrot" name="garrot" placeholder="Entrer le garrot" required>
        </div>
        <div class="form-group">
            <label for="librace"><b>Race :</b></label>
            <input type="text" id="librace" name="librace" onkeyup="autocompletRace('')" required>
            <input type="hidden" name="idrace" id="id_race">
            <ul id="nom_list_race_id" class="autocomplete-items"></ul>
        </div>
        <div class="form-group">
            <label for="librobe"><b>Robe :</b></label>
            <input type="text" id="librobe" name="librobe" onkeyup="autocompletRobe('')" required>
            <input type="hidden" name="idrobe" id="id_robe">
            <ul id="nom_list_robe_id" class="autocomplete-items"></ul>
        </div>
        <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
    </form>
</div>

<!-- Formulaire de modification -->
<div class="form-popup" id="modifierForm">
    <span class="close-btn" onclick="fermerFormulaire('modifierForm')">&times;</span>
    <form action="../traitement/traitement.cavalerie.php" method="POST" class="form-container">
        <h3>Modifier une cavalerie</h3>
        <input type="hidden" id="modifier_numsire" name="numsire">
        <div class="form-group">
            <label for="modifier_nomche"><b>Nom du Cheval :</b></label>
            <input type="text" id="modifier_nomche" name="nomche" placeholder="Entrer le nom du cheval" required>
        </div>
        <div class="form-group">
            <label for="modifier_datenache"><b>Date de Naissance :</b></label>
            <input type="date" id="modifier_datenache" name="datenache" required>
        </div>
        <div class="form-group">
            <label for="modifier_garrot"><b>Garrot :</b></label>
            <input type="number" id="modifier_garrot" name="garrot" placeholder="Entrer le garrot" required>
        </div>
        <div class="form-group">
            <label for="modifier_librace"><b>Race :</b></label>
            <input type="text" id="modifier_librace" name="librace" onkeyup="autocompletRace('modifier_')" required>
            <input type="hidden" name="idrace" id="modifier_id_race">
            <ul id="modifier_nom_list_race_id" class="autocomplete-items"></ul>
        </div>
        <div class="form-group">
            <label for="modifier_librobe"><b>Robe :</b></label>
            <input type="text" id="modifier_librobe" name="librobe" onkeyup="autocompletRobe('modifier_')" required>
            <input type="hidden" name="idrobe" id="modifier_id_robe">
            <ul id="modifier_nom_list_robe_id" class="autocomplete-items"></ul>
        </div>
        <button type="submit" name="modifier" class="btn-primary">Modifier</button>
    </form>
</div>


    <!-- Formulaire de suppression -->
    <div class="form-popup" id="supprimerForm">
        <span class="close-btn" onclick="fermerFormulaire('supprimerForm')">&times;</span>
        <form action="../traitement/traitement.cavalerie.php" method="POST" class="form-container">
            <h3>Supprimer une cavalerie</h3>
            <input type="hidden" id="supprimer_numsire" name="numsire">
            <button type="submit" name="supprimer" class="btn-danger">Supprimer</button>
        </form>
    </div>

    <!-- Tableau des cavaleries -->
    <h2>Liste des Cavaleries</h2>
    <table id="cavalerieTable" class="display">
        <thead>
            <tr>
                <th>Sélectionner</th>
                <th>Numsire</th>
                <th>Nom du Cheval</th>
                <th>Date de Naissance</th>
                <th>Garrot</th>
                <th>Race</th>
                <th>Robe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cavalerieList as $cavalerieItem): ?>
            <tr>
                <td><input type="checkbox" class="select-cavalerie"
                    data-numsire="<?= htmlspecialchars($cavalerieItem['numsire']) ?>"
                    data-nomche="<?= htmlspecialchars($cavalerieItem['nomche']) ?>"
                    data-datenache="<?= htmlspecialchars($cavalerieItem['datenache']) ?>"
                    data-garrot="<?= htmlspecialchars($cavalerieItem['garrot']) ?>"
                    data-race="<?= htmlspecialchars($cavalerie->CavalerieRace($cavalerieItem['idrace'])) ?>"
                    data-robe="<?= htmlspecialchars($cavalerie->CavalerieRobe($cavalerieItem['idrobe'])) ?>">
                </td>
                <td><?= htmlspecialchars($cavalerieItem['numsire']) ?></td>
                <td><?= htmlspecialchars($cavalerieItem['nomche']) ?></td>
                <td><?= htmlspecialchars($cavalerieItem['datenache']) ?></td>
                <td><?= htmlspecialchars($cavalerieItem['garrot']) ?></td>
                <td><?= htmlspecialchars($cavalerie->CavalerieRace($cavalerieItem['idrace'])) ?></td>
                <td><?= htmlspecialchars($cavalerie->CavalerieRobe($cavalerieItem['idrobe'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script>
$(document).ready(function() {
    if ($.fn.DataTable.isDataTable('#cavalerieTable')) {
        $('#cavalerieTable').DataTable().destroy();
    }

    $('#cavalerieTable').DataTable({
        "language": {
            "search": "Rechercher",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "lengthMenu": "Afficher _MENU_ entrées",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            }
        }
    });

    $(document).on('change', '.select-cavalerie', function() {
        var numsire = $(this).data('numsire');
        var nomche = $(this).data('nomche');
        var datenache = $(this).data('datenache');
        var garrot = $(this).data('garrot');
        var race = $(this).data('race');
        var robe = $(this).data('robe');

        if ($(this).is(':checked')) {
            $('#modifier_numsire').val(numsire);
            $('#modifier_nomche').val(nomche);
            $('#modifier_datenache').val(datenache);
            $('#modifier_garrot').val(garrot);
            $('#modifier_librace').val(race);
            $('#modifier_librobe').val(robe);
            $('#supprimer_numsire').val(numsire);
            $('#modifierButton').prop('disabled', false);
            $('#supprimerButton').prop('disabled', false);
        } else {
            $('#modifierButton').prop('disabled', true);
            $('#supprimerButton').prop('disabled', true);
        }
    });
});


    function basculerFormulaire(formId) {
        document.getElementById('ajoutForm').style.display = 'none';
        document.getElementById('modifierForm').style.display = 'none';
        document.getElementById('supprimerForm').style.display = 'none';
        document.getElementById(formId).style.display = 'block';
    }

    function fermerFormulaire(formId) {
        document.getElementById(formId).style.display = 'none';
    }
</script>

</body>
</html>
