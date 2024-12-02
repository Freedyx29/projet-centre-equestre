<?php
// Inclusion de la classe Robe et création d'une instance
include_once '../class/class.robe.php';
include_once '../include/haut.inc.php';

$robe = new Robe();
$listeRobes = $robe->RobeAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Robes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_crud.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Liste des Robes</h2>

        <!-- Section des messages d'alerte -->
        <?php
        if(isset($_GET['success']) && isset($_GET['message'])) {
            $alertClass = $_GET['success'] == 1 ? 'alert-success' : 'alert-danger';
        ?>
            <div class="alert <?php echo $alertClass; ?> alert-dismissible fade show">
                <?php echo htmlspecialchars($_GET['message']); ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        <?php } ?>
        <!-- Bouton Ajouter et Générer PDF -->
<div class="row mb-3">
    <div class="col-md-6">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
            Ajouter une robe
        </button>
        <!-- Bouton "Afficher le PDF" avec une couleur légèrement plus foncée -->
        <a href="../classpdf/classpdfrobe.php" class="btn" style="background-color: #B88C47; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-size: 16px; font-family: Arial, sans-serif;">
            📋 Afficher le PDF
        </a>
    </div>
    <div class="col-md-6">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
    </div>
</div>



        <!-- Tableau principal des robes -->
        <table class="table table-striped" id="robeTable">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listeRobes as $r):
                    if ($r['supprime'] != '1'): ?>
                    <tr>
                        <td><?php echo $r['librobe']; ?></td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $r['idrobe']; ?>">
                                Détail
                            </button>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $r['idrobe']; ?>">
                                Modifier
                            </button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $r['idrobe']; ?>">
                                Supprimer
                            </button>
                        </td>
                    </tr>
                <?php endif; endforeach; ?>
            </tbody>
        </table>

        <!-- Modal Ajout -->
        <div class="modal fade" id="ajoutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter une robe</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.robe.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Libellé</label>
                                <input type="text" name="librobe" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modals Modification, Suppression et Détail -->
        <?php foreach($listeRobes as $r):
            if ($r['supprime'] != '1'): ?>
            <!-- Modal Modification -->
            <div class="modal fade" id="modifModal<?php echo $r['idrobe']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modifier la robe</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="../traitement/traitement.robe.php" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="idrobe" value="<?php echo $r['idrobe']; ?>">
                                <div class="form-group">
                                    <label>Libellé</label>
                                    <input type="text" name="librobe" class="form-control" value="<?php echo $r['librobe']; ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="modifier" class="btn btn-warning">Modifier</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Suppression -->
            <div class="modal fade" id="suppModal<?php echo $r['idrobe']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmer la suppression</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer cette robe ?
                        </div>
                        <form action="../traitement/traitement.robe.php" method="post">
                            <input type="hidden" name="idrobe" value="<?php echo $r['idrobe']; ?>">
                            <div class="modal-footer">
                                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Détail -->
            <div class="modal fade" id="detailModal<?php echo $r['idrobe']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Détail de la robe</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="detail-group">
                                <label>ID Robe :</label>
                                <p><?php echo $r['idrobe']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Libellé :</label>
                                <p><?php echo $r['librobe']; ?></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Ensuite le script de pagination -->
<script>
$(document).ready(function(){
    // Variables de base
    var $rows = $("#robeTable tbody tr");
    var page = 1;
    var limit = 5;
    var total = Math.ceil($rows.length / limit);

    // Fonction pour afficher les lignes
    function showRows() {
        $rows.hide().slice((page-1)*limit, page*limit).show();
        $("#pageNum").text(`Page ${page}/${total}`);
    }

    // Modification de la fonction de recherche
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        if(value === "") {
            // Réinitialiser la pagination quand le champ est vide
            page = 1;
            $rows.hide();
            showRows();
        } else {
            // Pendant la recherche, afficher uniquement les résultats filtrés
            $("#robeTable tbody tr").each(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        }
    });

    // Ajoute les boutons et le numéro de page
    $("#robeTable").after(`
        <div class="text-center mt-3">
            <button id="prev" class="btn btn-brown">&laquo;</button>
            <span id="pageNum" class="mx-3">Page ${page}/${total}</span>
            <button id="next" class="btn btn-brown">&raquo;</button>
        </div>
    `);

    // Clics sur les boutons
    $("#next").click(() => { if(page < total) { page++; showRows(); }});
    $("#prev").click(() => { if(page > 1) { page--; showRows(); }});

    showRows();
});
</script>

</body>
</html>
