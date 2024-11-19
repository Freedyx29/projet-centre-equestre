<?php 
include_once '../class/class.race.php'; // Assurez-vous que le chemin est correct

$oRace = new Race();
$reqRace = $oRace->RaceALL(); // Supposons que vous avez une méthode pour obtenir toutes les races
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Races</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
   <style>
        /* CSS pour les pop-ups */
        .popup {
            display: none; 
            position: fixed; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            background-color: rgba(0,0,0,0.5); 
            z-index: 1000;
        }

        .popup-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .form-section button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Gestion des Races</h1>
    </header>

    <section class="form-section">
        <h2>Gestion des Races</h2>
        <button onclick="openPopup('addPopup')">Ajouter</button>
        <button id="editButton" onclick="openPopup('editPopup')" disabled>Modifier</button>
        <button id="deleteButton" onclick="openPopup('deletePopup')" disabled>Supprimer</button>
    </section>

    <section class="cards-section">
        <h2>Liste des Races</h2>
        <div class="cards-container">
            <table id="raceTable" class="display">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>ID</th>
                        <th>Nom de la race</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $races = $oRace->RaceALL(); // Appel de la méthode pour obtenir toutes les races
                    foreach ($races as $race) {
                        echo "<tr>
                            <td><input type='radio' name='selectedRace' class='race-radio' value='" . htmlspecialchars($race['idrace']) . "'></td>
                            <td>" . htmlspecialchars($race['idrace']) . "</td>
                            <td>" . htmlspecialchars($race['librace']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Popup pour ajouter une race -->
    <div id="addPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('addPopup')">&times;</span>
            <h2>Ajouter une race</h2>
            <form action="../traitement/traitement.race.php" method="POST">
                <input type="text" name="librace" placeholder="Nom de la race" required>
                <button type="submit" name="ajouter">Ajouter</button>
            </form>
        </div>
    </div>

    <!-- Popup pour modifier une race -->
    <div id="editPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('editPopup')">&times;</span>
            <h2>Modifier une race</h2>
            <form id="editForm" action="../traitement/traitement.race.php" method="POST">
                <input type="hidden" name="idrace" id="editId">
                <input type="text" name="librace" id="editLibrace" placeholder="Nom de la race" required>
                <button type="submit" name="modifier">Modifier La Race</button>
            </form>
        </div>
    </div>

    <!-- Popup pour supprimer une race -->
    <div id="deletePopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('deletePopup')">&times;</span>
            <h2>Êtes-vous sûr de vouloir supprimer cette race ?</h2>
            <button id="confirmDelete">Supprimer La Race </button>
            <button onclick="closePopup('deletePopup')">Annuler</button>
        </div>
    </div>

    <script>
        // Activation de DataTables sur la table des races
        $(document).ready(function() {
            $('#raceTable').DataTable();
        });

        // Activation des boutons "Modifier" et "Supprimer" lors de la sélection d'une race
        $('input[name="selectedRace"]').on('change', function() {
            const selectedRace = $('input[name="selectedRace"]:checked');
            if (selectedRace.length > 0) {
                $('#editId').val(selectedRace.val()); // Définir l'ID de la race sélectionnée pour la modification
                $('#editLibrace').val(selectedRace.closest('tr').find('td:eq(2)').text().trim()); // Récupérer le nom de la race
                
                $('#editButton').prop('disabled', false);
                $('#deleteButton').prop('disabled', false);
            }
        });

        // Suppression de la race sélectionnée
        $('#confirmDelete').on('click', function() {
            const selectedRace = $('input[name="selectedRace"]:checked');
            if (selectedRace.length > 0) {
                const id = selectedRace.val(); // Récupérer l'ID de la race sélectionnée
                $.post('../traitement/traitement.race.php', { supprimer: true, idrace: id }, function() {
                    window.location.reload(); // Recharger la page après la suppression
                });
            }
        });

        // Fonctions pour ouvrir et fermer les pop-ups
        function openPopup(popupId) {
            document.getElementById(popupId).style.display = 'block';
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = 'none';
        }
    </script>
</body>
</html>
