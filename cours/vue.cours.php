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
</head>
<body>
    <header style="text-align: center; margin: 20px 0;">
        <h1>Gestion des Cours</h1>
    </header>

    <section style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px;">
        <h2 style="text-align: center;">Ajouter / Modifier un Cours</h2>
        <form action="traitement.cours.php" method="POST">
            <input type="hidden" name="idcours" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : ''; ?>">
            
            <div style="margin-bottom: 15px;">
                <label for="libcours">Libellé:</label>
                <input type="text" name="libcours" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="hdebut">Heure de Début:</label>
                <input type="time" name="hdebut" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="hfin">Heure de Fin:</label>
                <input type="time" name="hfin" required>
            </div>

            <div style="text-align: center;">
                <button type="submit" name="<?php echo isset($_GET['edit']) ? 'update' : 'create'; ?>">
                    <?php echo isset($_GET['edit']) ? 'Mettre à jour' : 'Ajouter'; ?>
                </button>
            </div>
        </form>
    </section>

    <section style="max-width: 800px; margin: auto; padding: 20px;">
        <h2 style="text-align: center;">Liste des Cours</h2>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Heure de Début</th>
                    <th>Heure de Fin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coursList as $coursItem): ?>
                <tr>
                    <td><?php echo htmlspecialchars($coursItem['idcours']); ?></td>
                    <td><?php echo htmlspecialchars($coursItem['libcours']); ?></td>
                    <td><?php echo htmlspecialchars($coursItem['hdebut']); ?></td>
                    <td><?php echo htmlspecialchars($coursItem['hfin']); ?></td>
                    <td>
                        <a href="vue.cours.php?edit=<?php echo $coursItem['idcours']; ?>">Modifier</a> |
                        <a href="traitement.cours.php?delete=<?php echo $coursItem['idcours']; ?>">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>
</html>
