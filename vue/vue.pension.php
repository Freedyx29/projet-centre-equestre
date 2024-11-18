<?php

include_once '../class/class.pension.php';

$pension = new Pension();
$reqPensions = $pension->PensionALL();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pensions</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/script_pension.js"></script>
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
    <h2>CRUD Pensions</h2>

    <div class="center-button">
        <button class="btn-primary" onclick="basculerFormulaire('ajoutForm')">Ajouter une pension</button>
        <button class="btn-primary" id="modifierButton" onclick="basculerFormulaire('modifierForm')" disabled>Modifier une pension</button>
        <button class="btn-danger" id="supprimerButton" onclick="basculerFormulaire('supprimerForm')" disabled>Supprimer une pension</button>
    </div>

    <!-- Formulaire d'ajout -->
    <div class="form-popup" id="ajoutForm">
        <span class="close-btn" onclick="fermerFormulaire('ajoutForm')">&times;</span>
        <form action="../traitement/traitement.pension.php" method="POST" class="form-container">
            <h3>Ajouter une pension</h3>
            <div class="form-group">
                <label for="libpen"><b>Libellé de la pension :</b></label>
                <input type="text" id="libpen" name="libpen" placeholder="Entrer le libellé de la pension" required>
            </div>
            <div class="form-group">
                <label for="nomche"><b>Nom du cheval :</b></label>
                <input type="text" id="nomche" name="nomche" placeholder="Entrer le nom du cheval" onkeyup="autocompletPensionajout()" required>
                <ul id="nom_list_pension_id"></ul>
            </div>
            <input type="hidden" id="num_sire" name="numsire">
            <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Formulaire de modification -->
    <div class="form-popup" id="modifierForm">
        <span class="close-btn" onclick="fermerFormulaire('modifierForm')">&times;</span>
        <form action="../traitement/traitement.pension.php" method="POST" class="form-container">
            <h3>Modifier une pension</h3>
            <input type="hidden" id="modifier_idpen" name="idpen">
            <div class="form-group">
                <label for="modifier_libpen"><b>Libellé de la pension :</b></label>
                <input type="text" id="modifier_libpen" name="libpen" placeholder="Entrer le libellé de la pension" required>
            </div>
            <div class="form-group">
                <label for="modifier_nomche"><b>Nom du cheval :</b></label>
                <input type="text" id="modifier_nomche" name="nomche" placeholder="Entrer le nom du cheval" onkeyup="autocompletPension(0)" required>
                <ul id="modifier_nom_list_pension_id"></ul>
            </div>
            <input type="hidden" id="modifier_num_sire" name="numsire">
            <button type="submit" name="modifier" class="btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Formulaire de suppression -->
    <div class="form-popup" id="supprimerForm">
        <span class="close-btn" onclick="fermerFormulaire('supprimerForm')">&times;</span>
        <form action="../traitement/traitement.pension.php" method="POST" class="form-container">
            <h3>Supprimer une pension</h3>
            <input type="hidden" id="supprimer_idpen" name="idpen">
            <button type="submit" name="supprimer" class="btn-danger">Supprimer</button>
        </form>
    </div>

    <!-- Tableau des pensions -->
    <h2>Liste des Pensions</h2>
    <table id="pensionTable" class="display">
        <thead>
            <tr>
                <th>Sélectionner</th>
                <th>ID</th>
                <th>Libellé de la pension</th>
                <th>Nom du cheval</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($reqPensions as $unePension) {
                if ($unePension['supprime'] == '0') {
            ?>
            <tr>
                <td><input type="checkbox" class="select-pension" data-idpen="<?= htmlspecialchars($unePension['idpen']) ?>" data-libpen="<?= htmlspecialchars($unePension['libpen']) ?>" data-nomche="<?= htmlspecialchars($pension->PensionNumsire($unePension['numsire'])) ?>" data-numsire="<?= htmlspecialchars($unePension['numsire']) ?>"></td>
                <td><?= htmlspecialchars($unePension['idpen']) ?></td>
                <td><?= htmlspecialchars($unePension['libpen']) ?></td>
                <td><?= htmlspecialchars($pension->PensionNumsire($unePension['numsire'])) ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#pensionTable').DataTable({
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

        $(document).on('change', '.select-pension', function() {
            var idpen = $(this).data('idpen');
            var libpen = $(this).data('libpen');
            var nomche = $(this).data('nomche');
            var numsire = $(this).data('numsire');

            if ($(this).is(':checked')) {
                $('#modifier_idpen').val(idpen);
                $('#modifier_libpen').val(libpen);
                $('#modifier_nomche').val(nomche);
                $('#modifier_num_sire').val(numsire);
                $('#supprimer_idpen').val(idpen);
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
