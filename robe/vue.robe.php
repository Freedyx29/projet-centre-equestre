<?php 
include_once 'class.galop.php'; // Ensure the path is correct

$oGalop = new Galop();
$reqGalop = $oGalop->GalopALL(); // Assuming you have a method to get all galops
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Galops</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
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
    </style>
</head>
<body>
    <header>
        <h1>Gestion des Galops</h1>
    </header>

    <section class="form-section">
        <h2>Ajouter/Modifier/Supprimer un galop</h2>
        <button onclick="openPopup('addPopup')">Ajouter</button>
        <button id="editButton" onclick="openPopup('editPopup')" disabled>Modifier</button>
        <button id="deleteButton" onclick="openPopup('deletePopup')" disabled>Supprimer</button>
    </section>

    <section class="cards-section">
        <div class="cards-container">
            <table id="galopTable" class="display">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>ID</th>
                        <th>Nom du galop</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $galops = $oGalop->GalopALL(); // Call method to get all galops
                    foreach ($galops as $galop) {
                        echo "<tr>
                            <td><input type='radio' name='selectedGalop' class='galop-radio' value='" . htmlspecialchars($galop['idgalop']) . "'></td>
                            <td>" . htmlspecialchars($galop['idgalop']) . "</td>
                            <td>" . htmlspecialchars($galop['libgalop']) . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Popup for Adding a Galop -->
    <div id="addPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('addPopup')">&times;</span>
            <h2>Ajouter un galop</h2>
            <form action="traitement.galop.php" method="POST">
                <input type="text" name="libgalop" placeholder="Nom du galop" required>
                <button type="submit" name="ajouter">Ajouter</button>
            </form>
        </div>
    </div>

    <!-- Popup for Editing a Galop -->
    <div id="editPopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('editPopup')">&times;</span>
            <h2>Modifier un galop</h2>
            <form id="editForm" action="traitement.galop.php" method="POST">
                <input type="hidden" name="idgalop" id="editId">
                <input type="text" name="libgalop" id="editLibgalop" placeholder="Nom du galop" required>
                <button type="submit" name="modifier">Modifier</button>
            </form>
        </div>
    </div>

    <!-- Popup for Deleting a Galop -->
    <div id="deletePopup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup('deletePopup')">&times;</span>
            <h2>Êtes-vous sûr de vouloir supprimer ce galop ?</h2>
            <button id="confirmDelete">Supprimer</button>
            <button onclick="closePopup('deletePopup')">Annuler</button>
        </div>
    </div>

    <script>
        // Activate DataTables on the galop table
        $(document).ready(function() {
            $('#galopTable').DataTable();
        });

        // Enable buttons only when a galop is selected
        $('input[name="selectedGalop"]').on('change', function() {
            const selectedGalop = $('input[name="selectedGalop"]:checked');
            if (selectedGalop.length > 0) {
                $('#editId').val(selectedGalop.val()); // Set the ID of the selected galop for editing
                $('#editLibgalop').val(selectedGalop.closest('tr').find('td:eq(2)').text().trim()); // Get the name of the selected galop
                
                $('#editButton').prop('disabled', false);
                $('#deleteButton').prop('disabled', false);
            }
        });

        $('#confirmDelete').on('click', function() {
            const selectedGalop = $('input[name="selectedGalop"]:checked');
            if (selectedGalop.length > 0) {
                const id = selectedGalop.val(); // Get the ID of the selected galop
                $.post('traitement.galop.php', { supprimer: true, idgalop: id }, function() {
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
