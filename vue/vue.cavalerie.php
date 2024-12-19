<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduti'])) {
    $current_page = urlencode($_SERVER['PHP_SELF']);
    header("Location: ../vue/vue.index.php?redirect_to=" . $current_page);
    exit();
}

require_once '../class/class.cavalerie.php';
include_once '../include/haut.inc.php';
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        <div class="row mb-3">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                    <i class="fas fa-plus"></i>
                    <span>Ajouter une cavalerie</span>
                </button>
                <a href="../classpdf/classpdfcavalerie.php" class="btn" style="background-color: #B88C47; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-size: 16px; font-family: Arial, sans-serif;" target="_blank">
                    <i class="fas fa-file-pdf"></i>
                    <span>Afficher le PDF</span>
                </a>
            </div>
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
            </div>
        </div>

        <!-- Tableau principal des cavaleries -->
        <table class="table table-striped" id="cavalerieTable">
            <thead>
                <tr>
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
                        <td><?php echo $c['nomche']; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($c['datenache'])); ?></td>
                        <td><?php echo $c['garrot']; ?></td>
                        <td>
                            <?php
                            $singlePhoto = $cavalerie->getSinglePhotoByNumsire($c['numsire']);
                            if ($singlePhoto):
                                $photoPath = '../uploads/' . basename($singlePhoto);
                                if (file_exists($photoPath)): ?>
                                    <img src="<?php echo $photoPath; ?>" alt="<?php echo $c['nomche']; ?>" width="100">
                                <?php else: ?>
                                    <span>Photo introuvable : <?php echo basename($singlePhoto); ?></span>
                                <?php endif;
                            else: ?>
                                <span>Pas de photo</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $cavalerie->CavalerieRace($c['idrace']); ?></td>
                        <td><?php echo $cavalerie->CavalerieRobe($c['idrobe']); ?></td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $c['numsire']; ?>">
                                    <i class="fas fa-eye"></i>
                                    <span>Détail</span>
                                </button>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $c['numsire']; ?>">
                                    <i class="fas fa-edit"></i>
                                    <span>Modifier</span>
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $c['numsire']; ?>">
                                    <i class="fas fa-trash"></i>
                                    <span>Supprimer</span>
                                </button>
                            </div>
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
                    <form action="../traitement/traitement.cavalerie.php" method="post" enctype="multipart/form-data">
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
                        <form action="../traitement/traitement.cavalerie.php" method="post" enctype="multipart/form-data">
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
                                    <label>Ajouter une nouvelle photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Selectionner Pour La Suppression Des Photos Existantes</label>
                                    <?php
                                    $photos = $cavalerie->getPhotosByNumsire($c['numsire']);
                                    if (!empty($photos)):
                                        foreach ($photos as $photo):
                                            $photoPath = '../uploads/' . basename($photo['lienphoto']);
                                            if (file_exists($photoPath)): ?>
                                                <div>
                                                    <input type="checkbox" name="photos_to_delete[]" value="<?php echo $photo['idphotos']; ?>">
                                                    <img src="<?php echo $photoPath; ?>" alt="<?php echo $c['nomche']; ?>" width="100">
                                                </div>
                                            <?php else: ?>
                                                <div>
                                                    <input type="checkbox" name="photos_to_delete[]" value="<?php echo $photo['idphotos']; ?>">
                                                    <span>Photo introuvable : <?php echo basename($photo['lienphoto']); ?></span>
                                                </div>
                                            <?php endif;
                                        endforeach;
                                    else: ?>
                                        <span>Pas de photo</span>
                                    <?php endif; ?>
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
                                <label>Photos</label>
                                <?php
                                $photos = $cavalerie->getPhotosByNumsire($c['numsire']);
                                if (!empty($photos)):
                                    foreach ($photos as $photo):
                                        $photoPath = '../uploads/' . basename($photo['lienphoto']);
                                        if (file_exists($photoPath)): ?>
                                            <img src="<?php echo $photoPath; ?>" alt="<?php echo $c['nomche']; ?>" width="100">
                                        <?php else: ?>
                                            <span>Photo introuvable : <?php echo basename($photo['lienphoto']); ?></span>
                                        <?php endif;
                                    endforeach;
                                else: ?>
                                    <span>Pas de photo</span>
                                <?php endif; ?>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times"></i>
                                <span>Fermer</span>
                            </button>
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
        var $rows = $("#cavalerieTable tbody tr");
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
                $("#cavalerieTable tbody tr").each(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            }
        });

        // Ajoute les boutons et le numéro de page avec icônes de chevrons
        $("#cavalerieTable").after(`
            <div class="text-center mt-3">
                <button id="prev" class="btn btn-brown"><i class="fas fa-chevron-left"></i></button>
                <span id="pageNum" class="mx-3">Page ${page}/${total}</span>
                <button id="next" class="btn btn-brown"><i class="fas fa-chevron-right"></i></button>
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
