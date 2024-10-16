<?php
// Inclure le fichier de connexion à la base de données
include '../include/bdd.inc.php';

$pdo = connexionPDO();

// Vérifier si un ID a été passé pour la modification
if (isset($_GET['edit'])) {
    $numsire = $_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM cavalerie WHERE numsire = ?");
    $stmt->execute([$numsire]);
    $cavalerie = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $cavalerie = [];
}

// Récupérer les données de la table cavalerie
$query = $pdo->query("SELECT c.*, r.librace, b.librobe 
                      FROM cavalerie c 
                      JOIN race r ON c.idrace = r.idrace 
                      JOIN robe b ON c.idrobe = b.idrobe 
                      WHERE c.supprime = 0");
$cavaleries = $query->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les robes et races pour l'autocomplétion
$robes = $pdo->query("SELECT * FROM robe WHERE supprime = 0")->fetchAll(PDO::FETCH_ASSOC);
$races = $pdo->query("SELECT * FROM race WHERE supprime = 0")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Chevaux</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="../js/script.cavalerie.js"></script>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0;">
    <div class="container" style="width: 80%; max-width: 1200px; margin: 50px auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="text-align: center; color: #333;">Gestion des Chevaux</h2>

        <!-- Formulaire d'ajout/modification de cheval -->
        <div class="form-popup" id="ajoutForm" style="background-color: #f9f9f9; padding: 20px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 20px;">
            <form action="traitement.cavalerie.php" method="POST">
                <input type="hidden" name="numsire" value="<?= isset($cavalerie['numsire']) ? $cavalerie['numsire'] : ''; ?>">

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="nomche" style="font-weight: bold;">Nom du Cheval :</label>
                    <input type="text" id="nomche" name="nomche" 
                           value="<?= isset($cavalerie['nomche']) ? htmlspecialchars($cavalerie['nomche']) : ''; ?>" 
                           required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="datenache" style="font-weight: bold;">Date de Naissance :</label>
                    <input type="date" id="datenache" name="datenache" 
                           value="<?= isset($cavalerie['datenache']) ? htmlspecialchars($cavalerie['datenache']) : ''; ?>" 
                           required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="garrot" style="font-weight: bold;">Garrot :</label>
                    <input type="text" id="garrot" name="garrot" 
                           value="<?= isset($cavalerie['garrot']) ? htmlspecialchars($cavalerie['garrot']) : ''; ?>" 
                           required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="idrace" style="font-weight: bold;">Race :</label>
                    <input type="text" id="idrace" name="idrace" 
                           value="<?= isset($cavalerie['librace']) ? htmlspecialchars($cavalerie['librace']) : ''; ?>" 
                           required autocomplete="off" 
                           style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <input type="hidden" name="idrace_id" value="<?= isset($cavalerie['idrace']) ? $cavalerie['idrace'] : ''; ?>">
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="idrobe" style="font-weight: bold;">Robe :</label>
                    <input type="text" id="idrobe" name="idrobe" 
                           value="<?= isset($cavalerie['librobe']) ? htmlspecialchars($cavalerie['librobe']) : ''; ?>" 
                           required autocomplete="off" 
                           style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <input type="hidden" name="idrobe_id" value="<?= isset($cavalerie['idrobe']) ? $cavalerie['idrobe'] : ''; ?>">
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Ajouter/Modifier
                </button>
            </form>
        </div>

        <!-- Liste des chevaux -->
        <section>
            <h2 style="margin-bottom: 15px;">Liste des Chevaux</h2>
            <table border="1" cellspacing="0" cellpadding="5" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="text-align: left;">Num Sire</th>
                        <th style="text-align: left;">Nom</th>
                        <th style="text-align: left;">Date de Naissance</th>
                        <th style="text-align: left;">Garrot</th>
                        <th style="text-align: left;">Race</th>
                        <th style="text-align: left;">Robe</th>
                        <th style="text-align: left;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cavaleries as $cavalerie): ?>
                        <tr>
                            <td><?= htmlspecialchars($cavalerie['numsire']) ?></td>
                            <td><?= htmlspecialchars($cavalerie['nomche']) ?></td>
                            <td><?= htmlspecialchars($cavalerie['datenache']) ?></td>
                            <td><?= htmlspecialchars($cavalerie['garrot']) ?></td>
                            <td><?= htmlspecialchars($cavalerie['librace']) ?></td>
                            <td><?= htmlspecialchars($cavalerie['librobe']) ?></td>
                            <td>
                                <a href="?edit=<?= $cavalerie['numsire'] ?>" style="text-decoration: none; color: #007BFF;">Modifier</a> |
                                <a href="traitement.cavalerie.php?delete=<?= $cavalerie['numsire'] ?>" style="text-decoration: none; color: #D9534F;">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
