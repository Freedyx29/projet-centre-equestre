<?php
// Inclusion de la classe Pension et création d'une instance
include_once '../class/class.pension.php';
// Création d'une instance de la classe Pension
$pension = new Pension();
// Récupération de toutes les pensions depuis la base de données
$listePensions = $pension->PensionALL();
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

        <!-- Bouton Ajouter -->
        <div class="row mb-3">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                    Ajouter une pension
                </button>
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
                        <!-- <td><?php echo $p['idpen']; ?></td> -->
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
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $p['idpen']; ?>">
                                Supprimer
                            </button>
                        </td>
                    </tr>
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
                                <label>Tarif</label>
                                <input type="number" name="tarif" class="form-control" step="1" required>
                            </div>

                            <div class="form-group">
                                <label>Cheval</label>
                                <input type="text" id="nomche" class="form-control" onkeyup="autocompletPensionajout()" required>
                                <input type="hidden" id="num_sire" name="numsire">
                                <ul id="nom_list_pension_id"></ul>
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

        <!-- Modals Modification et Suppression -->
        <?php foreach($listePensions as $p): ?>
            <!-- Modal Modification -->
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
                                    <label>Tarif</label>
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
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#pensionTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    </script>
    
</body>
</html>
