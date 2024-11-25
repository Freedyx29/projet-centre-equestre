<?php
require_once '../class/class.cavalerie.php';
$cavalerie = new Cavalerie();
$cavalerieList = $cavalerie->CavalerieALL();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>CRUD Cavaleries</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_crud.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script_cavalerie.race.js"></script>
    <script src="../js/script_cavalerie.robe.js"></script>
</head>
<body>

    <div class="container mt-4">
        <h2>Liste des Cavaleries</h2>

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
                    Ajouter une cavalerie
                </button>
            </div>
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
            </div>
        </div>

        <!-- Tableau principal des cavaleries -->
        <table class="table table-striped" id="cavalerieTable">
            <thead>
                <tr>
                    <!-- <th>Numsire</th> -->
                    <th>Nom cheval</th>
                    <th>Date naissance</th>
                    <th>Garrot</th>
                    <th>Photo</th>
                    <th>Race</th>
                    <th>Robe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cavalerieList as $c): ?>
                    <tr>
                        <!-- <td><?php echo $c['numsire']; ?></td> -->
                        <td><?php echo $c['nomche']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($c['datenache'])); ?></td>
                        <td><?php echo $c['garrot']; ?></td>
                        <td><?php echo $c['photo']; ?></td>
                        <td><?php echo $cavalerie->CavalerieRace($c['idrace']); ?></td>
                        <td><?php echo $cavalerie->CavalerieRobe($c['idrobe']); ?></td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $c['numsire']; ?>">
                                Détail
                            </button>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $c['numsire']; ?>">
                                Modifier
                            </button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $c['numsire']; ?>">
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
                        <h4 class="modal-title">Ajouter une cavalerie</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.cavalerie.php" method="post">

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nom cheval</label>
                                <input type="text" name="nomche" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Date naissance</label>
                                <input type="date" name="datenache" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Garrot</label>
                                <input type="text" name="garrot" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="photo" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Race</label>
                                <input type="text" id="librace" class="form-control" onkeyup="autocompletRaceajout()" required>
                                <input type="hidden" id="id_race" name="idrace">
                                <ul id="nom_list_race_id"></ul>
                            </div>

                            <div class="form-group">
                                <label>Robe</label>
                                <input type="text" id="librobe" class="form-control" onkeyup="autocompletRobeajout()" required>
                                <input type="hidden" id="id_robe" name="idrobe">
                                <ul id="nom_list_robe_id"></ul>
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

        <!-- Modals Modification et Suppression et Détail-->
        <?php foreach($cavalerieList as $c): ?>
            <!-- Modal Modification -->
            <div class="modal fade" id="modifModal<?php echo $c['numsire']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modifier la cavalerie</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <form action="../traitement/traitement.cavalerie.php" method="post">

                            <div class="modal-body">

                                <input type="hidden" name="numsire" value="<?php echo $c['numsire']; ?>">

                                <div class="form-group">
                                    <label>Nom cheval</label>
                                    <input type="text" name="nomche" class="form-control" value="<?php echo $c['nomche']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Date naissance</label>
                                    <input type="date" name="datenache" class="form-control" value="<?php echo $c['datenache']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Garrot</label>
                                    <input type="text" name="garrot" class="form-control" value="<?php echo $c['garrot']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Photo</label>
                                    <input type="file" name="photo" class="form-control" value="<?php echo $c['photo']; ?>" required>
                                </div>  

                                <div class="form-group">
                                    <label>Race</label>
                                    <input type="text" id="librace<?php echo $c['numsire']; ?>" class="form-control"
                                           value="<?php echo $cavalerie->CavalerieRace($c['idrace']); ?>"
                                           onkeyup="autocompletRace(<?php echo $c['numsire']; ?>)" required>

                                    <input type="hidden" id="id_race<?php echo $c['numsire']; ?>" name="idrace" value="<?php echo $c['idrace']; ?>">
                                    <ul id="nom_list_race_id<?php echo $c['numsire']; ?>"></ul>
                                </div>
                                
                                <div class="form-group">
                                    <label>Robe</label>
                                    <input type="text" id="librobe<?php echo $c['numsire']; ?>" class="form-control"
                                           value="<?php echo $cavalerie->CavalerieRobe($c['idrobe']); ?>"
                                           onkeyup="autocompletRobe(<?php echo $c['numsire']; ?>)" required>

                                    <input type="hidden" id="id_robe<?php echo $c['numsire']; ?>" name="idrobe" value="<?php echo $c['idrobe']; ?>">
                                    <ul id="nom_list_robe_id<?php echo $c['numsire']; ?>"></ul>
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
            <div class="modal fade" id="suppModal<?php echo $c['numsire']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmer la suppression</h4>

                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer cette cavalerie ?
                        </div>

                        <form action="../traitement/traitement.cavalerie.php" method="post">
                            <input type="hidden" name="numsire" value="<?php echo $c['numsire']; ?>">

                            <div class="modal-footer">
                                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Détail -->
            <div class="modal fade" id="detailModal<?php echo $c['numsire']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Détails de la cavalerie</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <div class="detail-group">
                                <label>Num sire</label>
                                <p><?php echo $c['numsire']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Nom cheval</label>
                                <p><?php echo $c['nomche']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Date naissance</label>
                                <p><?php echo date('d/m/Y', strtotime($c['datenache'])); ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Garrot</label>
                                <p><?php echo $c['garrot']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Photo</label>
                                <p><?php echo $c['photo']; ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Race</label>
                                <p><?php echo $cavalerie->CavalerieRace($c['idrace']); ?></p>
                            </div>

                            <div class="detail-group">
                                <label>Robe</label>
                                <p><?php echo $cavalerie->CavalerieRobe($c['idrobe']); ?></p>
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
                $("#cavalerieTable tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</body>
</html>
