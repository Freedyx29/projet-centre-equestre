<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idadmin'])) {
    $current_page = urlencode($_SERVER['PHP_SELF']);
    header("Location: ../vue/vue.index.php?redirect_to=" . $current_page);
    exit();
}
include_once '../class/class.galop.php';
include_once '../include/haut.inc.php';

$galop = new Galop();
$listeGalops = $galop->GalopALL();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Galops</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_crud.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-4">

        <h2>Liste des Galops</h2>

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

        <div class="row mb-3">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter un galop</span>
                </button>
                <a href="../classpdf/classpdfgalop.php" class="btn" style="background-color: #B88C47; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-size: 16px; font-family: Arial, sans-serif;" target="_blank">
                    <i class="fas fa-file-pdf"></i>
                    <span>Afficher le PDF</span>
                </a>
            </div>
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
            </div>
        </div>

        <!-- Tableau principal des galops -->
        <table class="table table-striped" id="galopTable">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listeGalops as $g): ?>
                    <?php if ($g['supprime'] != '1'): ?>
                        <tr>
                            <td><?php echo $g['libgalop']; ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $g['idgalop']; ?>">
                                        <i class="fas fa-eye"></i>
                                        <span>Détail</span>
                                    </button>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $g['idgalop']; ?>">
                                        <i class="fas fa-edit"></i>
                                        <span>Modifier</span>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $g['idgalop']; ?>">
                                        <i class="fas fa-trash"></i>
                                        <span>Supprimer</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Modal Ajout -->
        <div class="modal fade" id="ajoutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un galop</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.galop.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Libellé</label>
                                <input type="text" name="libgalop" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="ajouter" class="btn btn-primary">
                                <i class="fas fa-check"></i>
                                <span>Ajouter</span>
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times"></i>
                                <span>Fermer</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modals Modification et Suppression et Détail -->
        <?php foreach($listeGalops as $g): ?>
            <?php if ($g['supprime'] != '1'): ?>
                <!-- Modal Modification -->
                <div class="modal fade" id="modifModal<?php echo $g['idgalop']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Modifier le galop</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form action="../traitement/traitement.galop.php" method="post">
                                <div class="modal-body">
                                    <input type="hidden" name="idgalop" value="<?php echo $g['idgalop']; ?>">
                                    <div class="form-group">
                                        <label>Libellé</label>
                                        <input type="text" name="libgalop" class="form-control" value="<?php echo $g['libgalop']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="modifier" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                        <span>Modifier</span>
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times"></i>
                                        <span>Fermer</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Suppression -->
                <div class="modal fade" id="suppModal<?php echo $g['idgalop']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Confirmer la suppression</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer ce galop ?
                            </div>
                            <form action="../traitement/traitement.galop.php" method="post">
                                <input type="hidden" name="idgalop" value="<?php echo $g['idgalop']; ?>">
                                <div class="modal-footer">
                                    <button type="submit" name="supprimer" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                        <span>Supprimer</span>
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        <i class="fas fa-times"></i>
                                        <span>Annuler</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Détail -->
                <div class="modal fade" id="detailModal<?php echo $g['idgalop']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Détail du galop</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="detail-group">
                                    <label>ID Galop :</label>
                                    <p><?php echo $g['idgalop']; ?></p>
                                </div>
                                <div class="detail-group">
                                    <label>Libellé :</label>
                                    <p><?php echo $g['libgalop']; ?></p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                    <span>Fermer</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function(){
        var $rows = $("#galopTable tbody tr");
        var page = 1;
        var limit = 5;
        var total = Math.ceil($rows.length / limit);

        function showRows() {
            $rows.hide().slice((page-1)*limit, page*limit).show();
            $("#pageNum").text(`Page ${page}/${total}`);
        }

        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            if(value === "") {
                page = 1;
                $rows.hide();
                showRows();
            } else {
                $("#galopTable tbody tr").each(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            }
        });

        $("#galopTable").after(`
            <div class="text-center mt-3">
                <button id="prev" class="btn btn-brown"><i class="fas fa-chevron-left"></i></button>
                <span id="pageNum" class="mx-3">Page ${page}/${total}</span>
                <button id="next" class="btn btn-brown"><i class="fas fa-chevron-right"></i></button>
            </div>
        `);

        $("#next").click(() => { if(page < total) { page++; showRows(); }});
        $("#prev").click(() => { if(page > 1) { page--; showRows(); }});

        showRows();
    });
    </script>

</body>
</html>
