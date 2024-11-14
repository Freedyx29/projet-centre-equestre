<?php

include_once '../class/class.evenements.php';

$evenement = new Evenements();
$reqEvenements = $evenement->getAllEvenements();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Evenements</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
    <h2>CRUD Evenements</h2>

    <div class="center-button">
        <button class="btn-primary" onclick="basculerFormulaire('ajoutForm')">Ajouter un évènement</button>
        <button class="btn-primary" id="modifierButton" onclick="basculerFormulaire('modifierForm')" disabled>Modifier un évènement</button>
        <button class="btn-danger" id="supprimerButton" onclick="basculerFormulaire('supprimerForm')" disabled>Supprimer un évènement</button>
    </div>

    <!-- Formulaire d'ajout -->
    <div class="form-popup" id="ajoutForm">
        <span class="close-btn" onclick="fermerFormulaire('ajoutForm')">&times;</span>
        <form action="traitement.evenements.php" method="POST" class="form-container">
            <h3>Ajouter un évènement</h3>
            <div class="form-group">
                <label for="titre"><b>Titre :</b></label>
                <input type="text" id="titre" name="titre" placeholder="Entrer le titre" required>
            </div>
            <div class="form-group">
                <label for="commentaire"><b>Commentaire :</b></label>
                <input type="text" id="commentaire" name="commentaire" placeholder="Entrer le commentaire" required>
            </div>
            <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Formulaire de modification -->
    <div class="form-popup" id="modifierForm">
        <span class="close-btn" onclick="fermerFormulaire('modifierForm')">&times;</span>
        <form action="traitement.evenements.php" method="POST" class="form-container">
            <h3>Modifier un évènement</h3>
            <input type="hidden" id="modifier_ideve" name="ideve">
            <div class="form-group">
                <label for="modifier_titre"><b>Titre :</b></label>
                <input type="text" id="modifier_titre" name="titre" placeholder="Entrer le titre" required>
            </div>
            <div class="form-group">
                <label for="modifier_commentaire"><b>Commentaire :</b></label>
                <input type="text" id="modifier_commentaire" name="commentaire" placeholder="Entrer le commentaire" required>
            </div>
            <button type="submit" name="modifier" class="btn-primary">Modifier</button>
        </form>
    </div>

    <!-- Formulaire de suppression -->
    <div class="form-popup" id="supprimerForm">
        <span class="close-btn" onclick="fermerFormulaire('supprimerForm')">&times;</span>
        <form action="traitement.evenements.php" method="POST" class="form-container">
            <h3>Supprimer un évènement</h3>
            <input type="hidden" id="supprimer_ideve" name="ideve">
            <button type="submit" name="supprimer" class="btn-danger">Supprimer</button>
        </form>
    </div>

    <!-- Tableau des évènements -->
    <h2>Liste des Evénements</h2>
    <table id="evenementTable" class="display">
        <thead>
            <tr>
                <th>Sélectionner</th>
                <th>ID</th>
                <th>Titre</th>
                <th>Commentaire</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($reqEvenements as $unEvenement) {
            ?>
            <tr>
                <td><input type="checkbox" class="select-evenement" data-ideve="<?= htmlspecialchars($unEvenement['ideve']) ?>" data-titre="<?= htmlspecialchars($unEvenement['titre']) ?>" data-commentaire="<?= htmlspecialchars($unEvenement['commentaire']) ?>"></td>
                <td><?= htmlspecialchars($unEvenement['ideve']) ?></td>
                <td><?= htmlspecialchars($unEvenement['titre']) ?></td>
                <td><?= htmlspecialchars($unEvenement['commentaire']) ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</div>

<script>
    $(document).ready(function() {
        $('#evenementTable').DataTable({
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

        $(document).on('change', '.select-evenement', function() {
            var ideve = $(this).data('ideve');
            var titre = $(this).data('titre');
            var commentaire = $(this).data('commentaire');

            if ($(this).is(':checked')) {
                $('#modifier_ideve').val(ideve);
                $('#modifier_titre').val(titre);
                $('#modifier_commentaire').val(commentaire);
                $('#supprimer_ideve').val(ideve);
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
