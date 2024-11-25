<?php
include_once '../class/class.cours.php';
$cours = new Cours();
$listeCours = $cours->CoursAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Cours</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_crud.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Liste des Cours</h2>

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

        <!-- Bouton Ajouter et Recherche -->
        <div class="row mb-3">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                    Ajouter un cours
                </button>
            </div>
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
            </div>
        </div>

        <!-- Tableau principal des cours -->
        <table class="table table-striped" id="coursTable">
            <thead>
                <tr>
                    <th>Libellé</th>
                    <th>Heure début</th>
                    <th>Heure fin</th>
                    <th>Jour</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listeCours as $c): 
                    if ($c['supprime'] != '1'): ?>
                    <tr>
                        <td><?php echo $c['libcours']; ?></td>
                        <td><?php echo $c['hdebut']; ?></td>
                        <td><?php echo $c['hfin']; ?></td>
                        <td><?php echo $c['jour']; ?></td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $c['idcours']; ?>">
                                Détail
                            </button>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $c['idcours']; ?>">
                                Modifier
                            </button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $c['idcours']; ?>">
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
                        <h4 class="modal-title">Ajouter un cours</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.cours.php" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Libellé</label>
                                <input type="text" name="libcours" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Heure début</label>
                                <input type="time" name="hdebut" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Heure fin</label>
                                <input type="time" name="hfin" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Jour</label>
                                <input type="text" name="jour" class="form-control" required>
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
        <?php foreach($listeCours as $c): 
            if ($c['supprime'] != '1'): ?>
            <!-- Modal Modification -->
            <div class="modal fade" id="modifModal<?php echo $c['idcours']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modifier le cours</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="../traitement/traitement.cours.php" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="idcours" value="<?php echo $c['idcours']; ?>">
                                <div class="form-group">
                                    <label>Libellé</label>
                                    <input type="text" name="libcours" class="form-control" value="<?php echo $c['libcours']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Heure début</label>
                                    <input type="time" name="hdebut" class="form-control" value="<?php echo $c['hdebut']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Heure fin</label>
                                    <input type="time" name="hfin" class="form-control" value="<?php echo $c['hfin']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jour</label>
                                    <input type="text" name="jour" class="form-control" value="<?php echo $c['jour']; ?>" required>
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
            <div class="modal fade" id="suppModal<?php echo $c['idcours']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmer la suppression</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer ce cours ?
                        </div>
                        <form action="../traitement/traitement.cours.php" method="post">
                            <input type="hidden" name="idcours" value="<?php echo $c['idcours']; ?>">
                            <div class="modal-footer">
                                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Détail -->
            <div class="modal fade" id="detailModal<?php echo $c['idcours']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Détail du cours</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="detail-group">
                                <label>ID Cours :</label>
                                <p><?php echo $c['idcours']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Libellé :</label>
                                <p><?php echo $c['libcours']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Heure début :</label>
                                <p><?php echo $c['hdebut']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Heure fin :</label>
                                <p><?php echo $c['hfin']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Jour :</label>
                                <p><?php echo $c['jour']; ?></p>
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
            $("#searchInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#coursTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>
