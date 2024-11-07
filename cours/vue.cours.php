<?php
require_once 'class.cours.php';
$cours = new Cours();
$coursList = $cours->read();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Cours</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <style>
        /* Styling for popup forms */
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
    <header style="text-align: center; margin: 20px 0;">
        <h1>Gestion des Cours</h1>
    </header>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm('addForm')">Ajouter un cours</button>
        <button class="btn-primary" id="editButton" onclick="toggleForm('editForm')" disabled>Modifier un cours</button>
        <button class="btn-danger" id="deleteButton" onclick="toggleForm('deleteForm')" disabled>Supprimer un cours</button>
    </div>

    <!-- Add Course Form -->
    <div class="form-popup" id="addForm">
        <span class="close-btn" onclick="closeForm('addForm')">&times;</span>
        <form action="traitement.cours.php" method="POST">
            <h2>Ajouter un Cours</h2>
            <label>Libellé:</label><input type="text" name="libcours" required>
            <label>Heure de Début:</label><input type="time" name="hdebut" required>
            <label>Heure de Fin:</label><input type="time" name="hfin" required>
            <label>Jour:</label>
            <select name="jour" required>
                <option value="Lundi">Lundi</option>
                <option value="Mardi">Mardi</option>
                <option value="Mercredi">Mercredi</option>
                <option value="Jeudi">Jeudi</option>
                <option value="Vendredi">Vendredi</option>
                <option value="Samedi">Samedi</option>
                <option value="Dimanche">Dimanche</option>
            </select>
            <button type="submit" name="create" class="btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Edit Course Form -->
    <div class="form-popup" id="editForm">
        <span class="close-btn" onclick="closeForm('editForm')">&times;</span>
        <form action="traitement.cours.php" method="POST">
            <h2>Modifier un Cours</h2>
            <input type="hidden" name="idcours" id="edit_idcours">
            <label>Libellé:</label><input type="text" name="libcours" id="edit_libcours" required>
            <label>Heure de Début:</label><input type="time" name="hdebut" id="edit_hdebut" required>
            <label>Heure de Fin:</label><input type="time" name="hfin" id="edit_hfin" required>
            <label>Jour:</label>
            <select name="jour" id="edit_jour" required>
                <option value="Lundi">Lundi</option>
                <option value="Mardi">Mardi</option>
                <option value="Mercredi">Mercredi</option>
                <option value="Jeudi">Jeudi</option>
                <option value="Vendredi">Vendredi</option>
                <option value="Samedi">Samedi</option>
                <option value="Dimanche">Dimanche</option>
            </select>
            <button type="submit" name="update" class="btn-primary">Mettre à jour</button>
        </form>
    </div>

    <!-- Delete Course Form -->
    <div class="form-popup" id="deleteForm">
        <span class="close-btn" onclick="closeForm('deleteForm')">&times;</span>
        <form action="traitement.cours.php" method="POST">
            <h2>Supprimer un Cours</h2>
            <input type="hidden" name="idcours" id="delete_idcours">
            <p>Voulez-vous vraiment supprimer ce cours ?</p>
            <button type="submit" name="delete" class="btn-danger">Supprimer</button>
        </form>
    </div>

    <!-- Course List Table -->
    <section style="max-width: 800px; margin: auto; padding: 20px;">
        <h2 style="text-align: center;">Liste des Cours</h2>
        <table id="courseTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Sélectionner</th>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Heure de Début</th>
                    <th>Heure de Fin</th>
                    <th>Jour</th> <!-- Nouvelle colonne pour le jour -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coursList as $coursItem): ?>
                <tr>
                    <td><input type="checkbox" class="select-course"
                        data-idcours="<?= htmlspecialchars($coursItem['idcours']) ?>"
                        data-libcours="<?= htmlspecialchars($coursItem['libcours']) ?>"
                        data-hdebut="<?= htmlspecialchars($coursItem['hdebut']) ?>"
                        data-hfin="<?= htmlspecialchars($coursItem['hfin']) ?>"
                        data-jour="<?= htmlspecialchars($coursItem['jour']) ?>"> <!-- Ajout de data-jour -->
                    </td>
                    <td><?php echo htmlspecialchars($coursItem['idcours']); ?></td>
                    <td><?php echo htmlspecialchars($coursItem['libcours']); ?></td>
                    <td><?php echo htmlspecialchars($coursItem['hdebut']); ?></td>
                    <td><?php echo htmlspecialchars($coursItem['hfin']); ?></td>
                    <td><?php echo htmlspecialchars($coursItem['jour']); ?></td> <!-- Affichage du jour -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <script>
        $(document).ready(function() {
            $('#courseTable').DataTable({
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

            $(document).on('change', '.select-course', function() {
                if ($(this).is(':checked')) {
                    $('#edit_idcours').val($(this).data('idcours'));
                    $('#edit_libcours').val($(this).data('libcours'));
                    $('#edit_hdebut').val($(this).data('hdebut'));
                    $('#edit_hfin').val($(this).data('hfin'));
                    $('#edit_jour').val($(this).data('jour')); // Remplir le champ jour
                    $('#delete_idcours').val($(this).data('idcours'));
                    $('#editButton').prop('disabled', false);
                    $('#deleteButton').prop('disabled', false);
                } else {
                    $('#editButton').prop('disabled', true);
                    $('#deleteButton').prop('disabled', true);
                }
            });
        });

        function toggleForm(formId) {
            document.getElementById('addForm').style.display = 'none';
            document.getElementById('editForm').style.display = 'none';
            document.getElementById('deleteForm').style.display = 'none';
            document.getElementById(formId).style.display = 'block';
        }

        function closeForm(formId) {
            document.getElementById(formId).style.display = 'none';
        }
    </script>
</body>
</html>
