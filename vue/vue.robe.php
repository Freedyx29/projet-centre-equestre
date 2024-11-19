<?php 
include '../class/class.robe.php';

$oRobe = new Robe();
$reqRobe = $oRobe->RobeALL(); // Assuming you have a method to get all robes
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Robes</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<style>
    /* CSS for Pop-ups */
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

    /* New CSS for the "Sélectionner" column */
    .select-column {
        width: 50px; /* Adjust the width as needed */
    }
</style>

</head>
<body>
    <header>
        <h1>Gestion des Robes</h1>
    </header>

    <section class="form-section">
        <h2>Gestion des Robes</h2>
        <button onclick="openPopup('addPopup')">Ajouter une robe</button>
        <button id="editButton" onclick="openPopup('editPopup')" disabled>Modifier une robe</button>
        <button id="deleteButton" onclick="openPopup('deletePopup')" disabled>Supprimer une robe</button>
    </section>

    <section class="cards-section">
        <h2>Liste des Robes</h2>
        <div class="cards-container">
   <table id="robeTable" class="display">
    <thead>
        <tr>
            <th class="select-column">Sélectionner</th>
            <th>ID</th>
            <th>Nom de la robe</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $robes = $oRobe->RobeALL(); // Call method to get all robes
        foreach ($robes as $robe) {
            echo "<tr>
                <td class='select-column'><input type='radio' name='selectedRobe' class='robe-radio' value='" . htmlspecialchars($robe['idrobe']) . "'></td>
                <td>" . htmlspecialchars($robe['idrobe']) . "</td>
                <td>" . htmlspecialchars($robe['librobe']) . "</td>
            </tr>";
        }
        ?>
    </tbody>
</table>

        </div>
    </section>

    <!-- Popup for Adding a Robe -->
    <div id="addPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('addPopup')">&times;</span>
            <h2>Ajouter une robe</h2>
            <form action="../traitement/traitement.robe.php" method="POST">
                <input type="text" name="librobe" placeholder="Nom de la robe" required>
                <button type="submit" name="ajouter">Ajouter</button>
            </form>
        </div>
    </div>

    <!-- Popup for Editing a Robe -->
    <div id="editPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('editPopup')">&times;</span>
            <h2>Modifier une robe</h2>
            <form id="editForm" action="../traitement/traitement.robe.php" method="POST">
                <input type="hidden" name="idrobe" id="editId">
                <input type="text" name="librobe" id="editLibrobe" placeholder="Nom de la robe" required>
                <button type="submit" name="modifier">Modifier</button>
            </form>
        </div>
    </div>

    <!-- Popup for Deleting a Robe -->
    <div id="deletePopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('deletePopup')">&times;</span>
            <h2>Êtes-vous sûr de vouloir supprimer cette robe ?</h2>
            <button id="confirmDelete">Supprimer</button>
            <button onclick="closePopup('deletePopup')">Annuler</button>
        </div>
    </div>

    <script>
        // Activation de DataTables sur la table des robes
        $(document).ready(function() {
            $('#robeTable').DataTable();
        });

        // Handler for radio button change
        $('input[name="selectedRobe"]').on('change', function() {
            const selectedRobe = $('input[name="selectedRobe"]:checked');
            if (selectedRobe.length > 0) {
                $('#editId').val(selectedRobe.val()); // Set the ID of the selected robe for editing
                $('#editLibrobe').val(selectedRobe.closest('tr').find('td:eq(2)').text().trim()); // Get the name of the selected robe
                
                $('#editButton').prop('disabled', false);
                $('#deleteButton').prop('disabled', false);
            }
        });

        $('#confirmDelete').on('click', function() {
            const selectedRobe = $('input[name="selectedRobe"]:checked');
            if (selectedRobe.length > 0) {
                const id = selectedRobe.val(); // Get the ID of the selected robe
                $.post('../traitement/traitement.robe.php', { supprimer: true, idrobe: id }, function() {
                    window.location.reload(); // Refresh the page after delete
                });
            }
        });

        function openPopup(popupId) {
            document.getElementById(popupId).style.display = 'block';
        }

        function closePopup(popupId) {
            document.getElementById(popupId).style.display = 'none';
        }
    </script>
</body>
</html>
