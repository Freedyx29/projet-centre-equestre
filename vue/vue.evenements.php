<?php
include_once '../include/haut.inc.php';
include_once '../class/class.evenements.php';

$evenements = new Evenements();
$listeEvenements = $evenements->EvenementsAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Evènements</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_crud.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2>Liste des Evènements</h2>

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
                Ajouter un évènement
            </button>
            <!-- Bouton "Afficher le PDF" avec une couleur légèrement plus foncée -->
            <a href="../classpdf/classpdfevenements.php" class="btn" style="background-color: #B88C47; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-size: 16px; font-family: Arial, sans-serif;" target="_blank">
                📋 Afficher le PDF
            </a>
        </div>
        <div class="col-md-6">
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
        </div>
    </div>

    <!-- Tableau principal des Evènements -->
    <table class="table table-striped" id="evenementsTable">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Commentaire</th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($listeEvenements as $e):
                if ($e['supprime'] != '1'): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($e['titre']); ?></td>
                        <td><?php echo htmlspecialchars($e['commentaire']); ?></td>
                        <td>
                            <?php
                            $singlePhoto = $evenements->getSinglePhotoByIdeve($e['ideve']);
                            if ($singlePhoto):
                                $photoPath = '../uploads/' . basename($singlePhoto);
                                if (file_exists($photoPath)): ?>
                                    <img src="<?php echo $photoPath; ?>" alt="<?php echo $e['titre']; ?>" width="100">
                                <?php else: ?>
                                    <span>Photo introuvable : <?php echo basename($singlePhoto); ?></span>
                                <?php endif;
                            else: ?>
                                <span>Pas de photo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $e['ideve']; ?>">
                                Détail
                            </button>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $e['ideve']; ?>">
                                Modifier
                            </button>
                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $e['ideve']; ?>">
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
                    <h4 class="modal-title">Ajouter un Evènement</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="../traitement/traitement.evenements.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" name="titre" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Commentaire</label>
                            <input type="text" name="commentaire" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">
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
    <?php foreach($listeEvenements as $e):
        if ($e['supprime'] != '1'): ?>
            <!-- Modal Modification -->
            <div class="modal fade" id="modifModal<?php echo $e['ideve']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modifier l'Evènement</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="../traitement/traitement.evenements.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="ideve" value="<?php echo $e['ideve']; ?>">
                                <div class="form-group">
                                    <label>Titre</label>
                                    <input type="text" name="titre" class="form-control" value="<?php echo $e['titre']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Commentaire</label>
                                    <input type="text" name="commentaire" class="form-control" value="<?php echo $e['commentaire']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Ajouter une nouvelle photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Photos existantes</label>
                                    <?php
                                    $photos = $evenements->getPhotosByIdeve($e['ideve']);
                                    if (!empty($photos)):
                                        foreach ($photos as $photo):
                                            $photoPath = '../uploads/' . basename($photo['lienphoto']);
                                            if (file_exists($photoPath)): ?>
                                                <div>
                                                    <input type="checkbox" name="photos_to_delete[]" value="<?php echo $photo['idphotos']; ?>">
                                                    <img src="<?php echo $photoPath; ?>" alt="<?php echo $e['titre']; ?>" width="100">
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
            <div class="modal fade" id="suppModal<?php echo $e['ideve']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmer la suppression</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer cet Evènement ?
                        </div>
                        <form action="../traitement/traitement.evenements.php" method="post">
                            <input type="hidden" name="ideve" value="<?php echo $e['ideve']; ?>">
                            <div class="modal-footer">
                                <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Détail -->
            <div class="modal fade" id="detailModal<?php echo $e['ideve']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Détail de l'Evènement</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="detail-group">
                                <label>ID Evènement :</label>
                                <p><?php echo $e['ideve']; ?></p>
                            </div>
                            <div class="detail-group">
                                <label>Titre :</label>
                                <p><?php echo $e['titre']; ?></p>
                            </div>
                            <div class="detail-group">
                                <label>Commentaire :</label>
                                <p><?php echo $e['commentaire']; ?></p>
                            </div>
                            <div class="detail-group">
                                <label>Photos</label>
                                <?php
                                $photos = $evenements->getPhotosByIdeve($e['ideve']);
                                if (!empty($photos)):
                                    foreach ($photos as $photo):
                                        $photoPath = '../uploads/' . basename($photo['lienphoto']);
                                        if (file_exists($photoPath)): ?>
                                            <img src="<?php echo $photoPath; ?>" alt="<?php echo $e['titre']; ?>" width="100">
                                        <?php else: ?>
                                            <span>Photo introuvable : <?php echo basename($photo['lienphoto']); ?></span>
                                        <?php endif;
                                    endforeach;
                                else: ?>
                                    <span>Pas de photo</span>
                                <?php endif; ?>
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
            $("#evenementsTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
</body>
</html>
