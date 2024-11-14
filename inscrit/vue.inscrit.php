<?php
require_once 'class.inscrit.php';
$inscrit = new Inscrit();
$inscritList = $inscrit->InscritALL();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Inscriptions</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="script.js"></script>

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
        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            border-bottom: none;
            border-top: none;
            z-index: 99;
            top: 100%;
            left: 0;
            right: 0;
        }
        .autocomplete-items div {
            padding: 10px;
            cursor: pointer;
            background-color: #fff;
            border-bottom: 1px solid #d4d4d4;
        }
        .autocomplete-items div:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <header style="text-align: center; margin: 20px 0;">
        <h1>Gestion des Inscriptions</h1>
    </header>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm('addForm')">Ajouter une inscription</button>
        <button class="btn-primary" id="modifierButton" onclick="toggleForm('editForm')" disabled>Modifier une inscription</button>
        <button class="btn-danger" id="supprimerButton" onclick="toggleForm('deleteForm')" disabled>Supprimer une inscription</button>
    </div>

    <!-- Add Inscrit Form -->
    <div class="form-popup" id="addForm">
        <span class="close-btn" onclick="closeForm('addForm')">&times;</span>
        <form action="traitement.inscrit.php" method="POST">
            <h2>Ajouter une Inscription</h2>
            <label>Cours:</label><input type="text" name="libcours" id="libcours" onkeyup="autocompletCours('')" required>
            <input type="hidden" name="idcours" id="id_cours" required>
            <ul id="nom_list_cours_id" class="autocomplete-items"></ul>
            <label>Cavalier:</label><input type="text" name="nomcava" id="nomcava" onkeyup="autocompletCava('')" required>
            <input type="hidden" name="idcava" id="id_cava" required>
            <ul id="nom_list_cava_id" class="autocomplete-items"></ul>
            <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Edit Inscrit Form -->
<!-- Edit Inscrit Form -->
<!-- Edit Inscrit Form -->
<div class="form-popup" id="editForm">
    <span class="close-btn" onclick="closeForm('editForm')">&times;</span>
    <form action="traitement.inscrit.php" method="POST">
        <h2>Modifier une Inscription</h2>
        <input type="hidden" name="idcours" id="modifier_idcours">
        <input type="hidden" name="idcava" id="modifier_idcava">
        <label>Cours:</label><input type="text" name="libcours" id="modifier_libcours" onkeyup="autocompletCours('modifier_')" required>
        <input type="hidden" name="new_idcours" id="modifier_id_cours" required>
        <ul id="modifier_nom_list_cours_id" class="autocomplete-items"></ul>
        <label>Cavalier:</label><input type="text" name="nomcava" id="modifier_nomcava" onkeyup="autocompletCava('modifier_')" required>
        <input type="hidden" name="new_idcava" id="modifier_id_cava" required>
        <ul id="modifier_nom_list_cava_id" class="autocomplete-items"></ul>
        <button type="submit" name="modifier" class="btn-primary">Mettre à jour</button>
    </form>
</div>






    <!-- Delete Inscrit Form -->
    <div class="form-popup" id="deleteForm">
        <span class="close-btn" onclick="closeForm('deleteForm')">&times;</span>
        <form action="traitement.inscrit.php" method="POST">
            <h2>Supprimer une Inscription</h2>
            <input type="hidden" name="idcours" id="supprimer_idcours">
            <input type="hidden" name="idcava" id="supprimer_idcava">
            <p>Voulez-vous vraiment supprimer cette inscription ?</p>
            <button type="submit" name="supprimer" class="btn-danger">Supprimer</button>
        </form>
    </div>

    <!-- Inscrit List Table -->
    <section style="max-width: 800px; margin: auto; padding: 20px;">
        <h2 style="text-align: center;">Liste des Inscriptions</h2>
        <table id="inscritTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Sélectionner</th>
                    <th>Cours</th>
                    <th>Cavalier</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscritList as $inscritItem): ?>
                <tr>
                    <td><input type="checkbox" class="select-inscrit"
                        data-idcours="<?= htmlspecialchars($inscritItem['idcours']) ?>"
                        data-idcava="<?= htmlspecialchars($inscritItem['idcava']) ?>"
                        data-libcours="<?= htmlspecialchars($inscritItem['libcours']) ?>"
                        data-nomcava="<?= htmlspecialchars($inscritItem['nomcava']) ?>">
                    </td>
                    <td><?php echo htmlspecialchars($inscritItem['libcours']); ?></td>
                    <td><?php echo htmlspecialchars($inscritItem['nomcava']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
