<?php
require_once 'class.cavalerie.php';
$cavalerie = new Cavalerie();
$cavalerieList = $cavalerie->CavalerieALL();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Cavaleries</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css"> <!-- Lien vers le fichier CSS externe -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="script.js"></script>
</head>
<body>
    <header>
        <h1>Gestion des Cavaleries</h1>
    </header>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm('addForm')">Ajouter une cavalerie</button>
        <button class="btn-primary" id="modifierButton" onclick="toggleForm('editForm')" disabled>Modifier une cavalerie</button>
        <button class="btn-danger" id="supprimerButton" onclick="toggleForm('deleteForm')" disabled>Supprimer une cavalerie</button>
    </div>

    <!-- Add Cavalerie Form -->
    <div class="form-popup" id="addForm">
        <span class="close-btn" onclick="closeForm('addForm')">&times;</span>
        <form action="traitement.cavalerie.php" method="POST">
            <h2>Ajouter une Cavalerie</h2>
            <label>Nom du Cheval:</label><input type="text" name="nomche" required>
            <label>Date de Naissance:</label><input type="date" name="datenache" required>
            <label>Garrot:</label><input type="number" name="garrot" required>
            <label>Race:</label><input type="text" name="librace" id="librace" onkeyup="autocompletRace('')" required>
            <input type="hidden" name="idrace" id="id_race">
            <ul id="nom_list_race_id" class="autocomplete-items"></ul>
            <label>Robe:</label><input type="text" name="librobe" id="librobe" onkeyup="autocompletRobe('')" required>
            <input type="hidden" name="idrobe" id="id_robe">
            <ul id="nom_list_robe_id" class="autocomplete-items"></ul>
            <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
        </form>
    </div>

    <!-- Edit Cavalerie Form -->
    <div class="form-popup" id="editForm">
        <span class="close-btn" onclick="closeForm('editForm')">&times;</span>
        <form action="traitement.cavalerie.php" method="POST">
            <h2>Modifier une Cavalerie</h2>
            <input type="hidden" name="numsire" id="modifier_numsire">
            <label>Nom du Cheval:</label><input type="text" name="nomche" id="modifier_nomche" required>
            <label>Date de Naissance:</label><input type="date" name="datenache" id="modifier_datenache" required>
            <label>Garrot:</label><input type="number" name="garrot" id="modifier_garrot" required>
            <label>Race:</label><input type="text" name="librace" id="modifier_librace" onkeyup="autocompletRace('modifier_')" required>
            <input type="hidden" name="idrace" id="modifier_id_race">
            <ul id="modifier_nom_list_race_id" class="autocomplete-items"></ul>
            <label>Robe:</label><input type="text" name="librobe" id="modifier_librobe" onkeyup="autocompletRobe('modifier_')" required>
            <input type="hidden" name="idrobe" id="modifier_id_robe">
            <ul id="modifier_nom_list_robe_id" class="autocomplete-items"></ul>
            <button type="submit" name="modifier" class="btn-primary">Mettre à jour</button>
        </form>
    </div>

    <!-- Delete Cavalerie Form -->
    <div class="form-popup" id="deleteForm">
        <span class="close-btn" onclick="closeForm('deleteForm')">&times;</span>
        <form action="traitement.cavalerie.php" method="POST">
            <h2>Supprimer une Cavalerie</h2>
            <input type="hidden" name="numsire" id="supprimer_numsire">
            <p>Voulez-vous vraiment supprimer cette cavalerie ?</p>
            <button type="submit" name="supprimer" class="btn-danger">Supprimer</button>
        </form>
    </div>

    <!-- Cavalerie List Table -->
    <section>
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
    </section>
</body>
</html>
