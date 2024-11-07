<?php
// Inclure la connexion à la base de données
include('../include/bdd.inc.php');
$conn = connexionPDO();

// Récupérer la liste des cavaliers pour afficher éventuellement
$cavaliers = $conn->query("SELECT * FROM cavalerie")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Cavaliers</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="../js/script.cavalerie.js"></script>
</head>
<body>
    <h1>Gestion des Cavaliers</h1>
    <form action="traitement.cavalerie.php" method="POST">
        <label for="nomche">Nom du Cheval:</label>
        <input type="text" name="nomche" required><br>

        <label for="datenache">Date de Naissance:</label>
        <input type="date" name="datenache" required><br>

        <label for="garrot">Garrot:</label>
        <input type="text" name="garrot" required><br>

        <label for="idrace">Race:</label>
        <input type="text" id="idrace" required>
        <input type="hidden" id="idrace_hidden" name="idrace_hidden"><br>

        <label for="idrobe">Robe:</label>
        <input type="text" id="idrobe" required>
        <input type="hidden" id="idrobe_hidden" name="idrobe_hidden"><br>

        <input type="submit" value="Ajouter Cavalier">
    </form>

    <h2>Liste des Cavaliers</h2>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Date de Naissance</th>
            <th>Garrot</th>
            <th>Race</th>
            <th>Robe</th>
        </tr>
        <?php foreach ($cavaliers as $cavalier): ?>
        <tr>
            <td><?= htmlspecialchars($cavalier['nomche']) ?></td>
            <td><?= htmlspecialchars($cavalier['datenache']) ?></td>
            <td><?= htmlspecialchars($cavalier['garrot']) ?></td>
            <td><?= htmlspecialchars($cavalier['idrace']) ?></td>
            <td><?= htmlspecialchars($cavalier['idrobe']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>