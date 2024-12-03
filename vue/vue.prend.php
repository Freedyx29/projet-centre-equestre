<?php

include_once '../include/haut.inc.php';
include_once '../class/class.prend.php';
$prend = new Prend();
$listePrends = $prend->PrendALL();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Prêts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_crud.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script_prend.cava.js"></script>
    <script src="../js/script_prend.pen.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Liste des Prêts</h2>

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
                Ajouter un prêt
            </button>
            <!-- Bouton "Afficher le PDF" avec une couleur légèrement plus foncée -->
            <a href="../classpdf/classpdfprend.php" class="btn" style="background-color: #B88C47; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-size: 16px; font-family: Arial,"target="_blank";>
            </a>
        </div>
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
        </div>
    </div>


        <!-- Tableau des prêts -->
        <table class="table table-striped" id="prendTable">
            <thead>
                <tr>
                    <th>Cavaliers</th>
                    <th>Pensions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listePrends as $p): 
                    if($p['supprime'] != '1'): ?>
                <tr>
                    <td><?php echo $prend->PrendCava($p['refidcava']); ?></td>
                    <td><?php echo $prend->PrendPen($p['refidpen']); ?></td>
                    <td>
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $p['refidcava'] . '_' . $p['refidpen']; ?>">
                            Détail
                        </button>
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $p['refidcava'] . '_' . $p['refidpen']; ?>">
                            Modifier
                        </button>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#supprModal<?php echo $p['refidcava'] . '_' . $p['refidpen']; ?>">
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
                        <h4 class="modal-title">Ajouter un prêt</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.prend.php" method="post">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Cavalier</label>
                                <input type="text" id="nomcava" name="nomcava" class="form-control" onkeyup="autocompletPrendCavaajout()" required>
                                <input type="hidden" name="idcava" id="id_cava">
                                <ul id="nom_list_prend_cava_id"></ul>
                            </div>

                            <div class="form-group">
                                <label>Pension</label>
                                <input type="text" id="libpen" name="libpen" class="form-control" onkeyup="autocompletPrendPenajout()" required>
                                <input type="hidden" name="idpen" id="id_pen">
                                <ul id="nom_list_prend_pen_id"></ul>
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

        <!-- Modals Modification et Suppression et Détail -->
        <?php foreach($listePrends as $p):
        if($p['supprime'] != '1'): ?>

        <!-- Modal Modification -->
        <div class="modal fade" id="modifModal<?php echo $p['refidcava'] . '_' . $p['refidpen']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier le prêt</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.prend.php" method="post">
                        <div class="modal-body">

                            <input type="hidden" name="refidcava" value="<?php echo $p['refidcava']; ?>">
                            <input type="hidden" name="refidpen" value="<?php echo $p['refidpen']; ?>">

                            <input type="hidden" name="id_cava_first" value="<?php echo $p['refidcava']; ?>">
                            <input type="hidden" name="id_pen_first" value="<?php echo $p['refidpen']; ?>">

                            <div class="form-group">
                                <label>Cavalier</label>
                                <input type="text"
                                       id="nomcava<?php echo $p['refidcava']; ?>"
                                       class="form-control"
                                       value="<?php echo $prend->PrendCava($p['refidcava']); ?>"
                                       onkeyup="autocompletPrendCava('<?php echo $p['refidcava']; ?>')"
                                       required>

                                <input type="hidden" name="idcava" 
                                       id="id_cava<?php echo $p['refidcava']; ?>"
                                       value="<?php echo $p['refidcava']; ?>">

                                <ul id="nom_list_prend_cava_id<?php echo $p['refidcava']; ?>"></ul>
                            </div>

                            <div class="form-group">
                                <label>Pension</label>
                                <input type="text"
                                       id="libpen<?php echo $p['refidpen']; ?>"
                                       class="form-control"
                                       value="<?php echo $prend->PrendPen($p['refidpen']); ?>"
                                       onkeyup="autocompletPrendPen('<?php echo $p['refidpen']; ?>')"
                                       required>

                                <input type="hidden" name="idpen" 
                                       id="id_pen<?php echo $p['refidpen']; ?>"
                                       value="<?php echo $p['refidpen']; ?>">

                                <ul id="nom_list_prend_pen_id<?php echo $p['refidpen']; ?>"></ul>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- Modal Suppression -->
        <div class="modal fade" id="supprModal<?php echo $p['refidcava'] . '_' . $p['refidpen']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmer la suppression</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer ce prêt ?
                    </div>

                    <form action="../traitement/traitement.prend.php" method="post">
                        <input type="hidden" name="refidcava" value="<?php echo $p['refidcava']; ?>">
                        <input type="hidden" name="refidpen" value="<?php echo $p['refidpen']; ?>">
                    

                        <div class="modal-footer">
                            <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Détail -->
        <div class="modal fade" id="detailModal<?php echo $p['refidcava'] . '_' . $p['refidpen']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Détails du prêt</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="detail-group">
                            <label>Cavalier</label>
                            <p><?php echo $prend->PrendCava($p['refidcava']); ?></p>
                        </div>

                        <div class="detail-group">
                            <label>Pension</label>
                            <p><?php echo $prend->PrendPen($p['refidpen']); ?></p>
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

    <script>
$(document).ready(function(){
    // Variables de base
    var $rows = $("#prendTable tbody tr");
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
            $("#prendTable tbody tr").each(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        }
    });

    // Ajoute les boutons et le numéro de page
    $("#prendTable").after(`
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
