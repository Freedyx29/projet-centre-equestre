<?php
// Inclusion de la classe Pension et création d'une instance
include_once '../class/class.pension.php';
include_once '../include/haut.inc.php';

// Création d'une instance de la classe Pension
$pension = new Pension();
// Récupération de toutes les pensions depuis la base de données
$listePensions = $pension->PensionALL();

// Démarrer la session pour récupérer l'autre nom de cavalier
session_start();
$autre_nom_cavalier = isset($_SESSION['autre_nom_cavalier']) ? $_SESSION['autre_nom_cavalier'] : '';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Pensions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_crud.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script_pension.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Liste des Pensions</h2>

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
                    Ajouter une pension
                </button>
                <!-- Bouton "Afficher le PDF" avec une couleur légèrement plus foncée -->
                <a href="../classpdf/classpdfpension.php" class="btn" style="background-color: #B88C47; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-size: 16px; font-family: Arial, sans-serif" target="_blank">
                    📋 Afficher le PDF
                </a>
            </div>
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
            </div>
        </div>

        <!-- Tableau principal des pensions -->
        <table class="table table-striped" id="pensionTable">
    <thead>
        <tr>
            <!-- <th>ID</th> -->
            <th>Libellé</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Tarif</th>
            <th>Cheval</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listePensions as $p): ?>
            <tr>
                <td><?php echo $p['libpen']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($p['dateD'])); ?></td>
                <td><?php echo date('d/m/Y', strtotime($p['dateF'])); ?></td>
                <td><?php echo $p['tarif']; ?> €</td>
                <td><?php echo $pension->PensionNumsire($p['numsire']); ?></td>
                <td>
                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $p['idpen']; ?>">
                        Détail
                    </button>
                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $p['idpen']; ?>">
                        Modifier
                    </button>
                    <button class="btn-delete" data-toggle="modal" data-target="#suppModal<?php echo $p['idpen']; ?>">
                        Supprimer
                    </button>
                </td>
            </tr>
            <script>
                console.log("Pension ID: <?php echo $p['idpen']; ?>, Libellé: <?php echo $p['libpen']; ?>, Date début: <?php echo $p['dateD']; ?>, Date fin: <?php echo $p['dateF']; ?>, Tarif: <?php echo $p['tarif']; ?>, Cheval: <?php echo $pension->PensionNumsire($p['numsire']); ?>, Cavalier 1: <?php echo isset($p['nomcava1']) ? $p['nomcava1'] : 'N/A'; ?>, Cavalier 2: <?php echo isset($p['nomcava2']) ? $p['nomcava2'] : 'N/A'; ?>");
            </script>
        <?php endforeach; ?>
    </tbody>
</table>


        <!-- Modal Ajout -->
        <div class="modal fade" id="ajoutModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter une pension</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.pension.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Libellé</label>
                                <input type="text" name="libpen" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Date début</label>
                                <input type="date" name="dateD" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Date fin</label>
                                <input type="date" name="dateF" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tarif en euro</label>
                                <input type="number" name="tarif" class="form-control" step="1" required>
                            </div>
                            <div class="form-group">
                                <label>Cheval</label>
                                <input type="text" id="nomche" class="form-control" onkeyup="autocompletPensionajout()" required>
                                <input type="hidden" id="num_sire" name="numsire">
                                <ul id="nom_list_pension_id"></ul>
                            </div>
                            <div class="form-group">
                                <label>Nom Cavalier 1</label>
                                <input type="text" id="nomcava1" class="form-control" onkeyup="autocompletCavalierajout1()" required>
                                <input type="hidden" id="idcava1" name="idcava1">
                                <ul id="nom_list_cavalier_id1"></ul>
                            </div>
                            <div class="form-group">
                                <label>Nom Cavalier 2</label>
                                <input type="text" id="nomcava2" class="form-control" onkeyup="autocompletCavalierajout2()" required>
                                <input type="hidden" id="idcava2" name="idcava2">
                                <ul id="nom_list_cavalier_id2"></ul>
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

    <!-- Modal Modification -->
<?php foreach($listePensions as $p): ?>
    <div class="modal fade" id="modifModal<?php echo $p['idpen']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifier la pension</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="../traitement/traitement.pension.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="idpen" value="<?php echo $p['idpen']; ?>">
                        <div class="form-group">
                            <label>Libellé</label>
                            <input type="text" name="libpen" class="form-control" value="<?php echo $p['libpen']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Date début</label>
                            <input type="date" name="dateD" class="form-control" value="<?php echo $p['dateD']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Date fin</label>
                            <input type="date" name="dateF" class="form-control" value="<?php echo $p['dateF']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Tarif en euro</label>
                            <input type="number" name="tarif" class="form-control" step="1" value="<?php echo $p['tarif']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Cheval</label>
                            <input type="text" id="nomche<?php echo $p['idpen']; ?>" class="form-control"
                                   value="<?php echo $pension->PensionNumsire($p['numsire']); ?>"
                                   onkeyup="autocompletPension(<?php echo $p['idpen']; ?>)" required>
                            <input type="hidden" id="num_sire<?php echo $p['idpen']; ?>" name="numsire" value="<?php echo $p['numsire']; ?>">
                            <ul id="nom_list_pension_id<?php echo $p['idpen']; ?>"></ul>
                        </div>
                        <?php
                        $cavaliers = $pension->getCavaliersForPension($p['idpen']);
                        $nomcava1 = isset($cavaliers[0]['nomcava']) ? $cavaliers[0]['nomcava'] : '';
                        $nomcava2 = isset($cavaliers[1]['nomcava']) ? $cavaliers[1]['nomcava'] : '';
                        ?>
                        <div class="form-group">
                            <label>Nom Cavalier 1</label>
                            <input type="text" id="nomcava3" class="form-control"
                                   value="<?php echo $nomcava1; ?>"
                                   onkeyup="autocompletCavaliermodif1(<?php echo $p['idpen']; ?>)" required>
                            <input type="hidden" id="idcava3" name="idcava3" value="<?php echo isset($cavaliers[0]['idcava']) ? $cavaliers[0]['idcava'] : ''; ?>">
                            <ul id="nom_list_cavalier_id3"></ul>
                        </div>
                        <div class="form-group">
                            <label>Nom Cavalier 2</label>
                            <input type="text" id="nomcava4" class="form-control"
                                   value="<?php echo $nomcava2; ?>"
                                   onkeyup="autocompletCavaliermodif2(<?php echo $p['idpen']; ?>)" >
                            <input type="hidden" id="idcava4" name="idcava4" value="<?php echo isset($cavaliers[1]['idcava']) ? $cavaliers[1]['idcava'] : ''; ?>">
                            <ul id="nom_list_cavalier_id4"></ul>
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
            <div class="modal fade" id="suppModal<?php echo $p['idpen']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmer la suppression</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer cette pension ?
                        </div>
                        <form action="../traitement/traitement.pension.php" method="post">
                            <input type="hidden" name="idpen" value="<?php echo $p['idpen']; ?>">
                            <div class="modal-footer">
                                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Détail -->
            <div class="modal fade" id="detailModal<?php echo $p['idpen']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Détails de la pension</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="detail-group">
                                <label>ID Pension :</label>
                                <p><?php echo $p['idpen']; ?></p>
                            </div>
                            <div class="detail-group">
                                <label>Libellé :</label>
                                <p><?php echo $p['libpen']; ?></p>
                            </div>
                            <div class="detail-group">
                                <label>Date de début :</label>
                                <p><?php echo date('d/m/Y', strtotime($p['dateD'])); ?></p>
                            </div>
                            <div class="detail-group">
                                <label>Date de fin :</label>
                                <p><?php echo date('d/m/Y', strtotime($p['dateF'])); ?></p>
                            </div>
                            <div class="detail-group">
                                <label>Tarif :</label>
                                <p><?php echo $p['tarif']; ?> €</p>
                            </div>
                            <div class="detail-group">
                                <label>Cheval :</label>
                                <p><?php echo $pension->PensionNumsire($p['numsire']); ?></p>
                            </div>
                            <?php
                            $cavaliers = $pension->getCavaliersForPension($p['idpen']);
                            if (!empty($cavaliers)) {
                                foreach ($cavaliers as $index => $cavalier) {
                                    echo '<div class="detail-group">';
                                    echo '<label>Nom Cavalier ' . ($index + 1) . ' :</label>';
                                    echo '<p>' . $cavalier['nomcava'] . '</p>';
                                    echo '</div>';
                                }
                            } else {
                                echo '<div class="detail-group">';
                                echo '<label>Nom Cavalier 1 :</label>';
                                echo '<p>N/A</p>';
                                echo '</div>';
                                echo '<div class="detail-group">';
                                echo '<label>Nom Cavalier 2 :</label>';
                                echo '<p>N/A</p>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
$(document).ready(function(){
    // Variables de base
    var $rows = $("#pensionTable tbody tr");
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
            $("#pensionTable tbody tr").each(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        }
    });

    // Ajoute les boutons et le numéro de page
    $("#pensionTable").after(`
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
