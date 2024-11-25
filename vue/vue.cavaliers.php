<?php
// Inclusion de la classe Cavalier et création d'une instance
include_once '../class/class.cavaliers.php';
// Création d'une instance de la classe Cavalier
$cavalier = new Cavaliers();
// Récupération de toutes les cavaliers depuis la base de données
$cavaliersList = $cavalier->CavaliersALL();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Gestion des Cavaliers</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../css/style_crud.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../js/script_cavaliers.js"></script>
    </head>
    <body>
        <div class="container mt-4">
            <h2>Liste des Cavaliers</h2>

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
                        Ajouter un cavalier
                    </button>
                </div>
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
                </div>
            </div>

            <!-- Tableau principal des cavaliers -->
            <table class="table table-striped" id="cavalierTable">
                <thead>
                    <tr>
                        <th>Nom cavalier</th>
                        <th>Prénom cavalier</th>
                        <th>Date de naissance</th>
                        <th>Numéro de licence</th>
                        <th>Galop</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cavaliersList as $c): ?>
                        <tr>
                            <td><?php echo $c['nomcava']; ?></td>
                            <td><?php echo $c['prenomcava']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($c['datenacava'])); ?></td>
                            <td><?php echo $c['numlic']; ?></td>
                            <td><?php echo $cavalier->CavaliersGalop($c['idgalop']); ?></td>
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $c['idcava']; ?>">
                                    Détail
                                </button>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $c['idcava']; ?>">
                                    Modifier
                                </button>
                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $c['idcava']; ?>">
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
                            <h4 class="modal-title">Ajouter un cavalier</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form action="../traitement/traitement.cavaliers.php" method="post">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Nom cavalier</label>
                                    <input type="text" name="nomcava" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Prénom cavalier</label>
                                    <input type="text" name="prenomcava" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Date de naissance</label>
                                    <input type="date" name="datenacava" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Numéro de licence</label>
                                    <input type="text" name="numlic" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Nom responsable</label>
                                    <input type="text" name="nomresp" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Prénom responsable</label>
                                    <input type="text" name="prenomresp" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Rue responsable</label>
                                    <input type="text" name="rueresp" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Ville responsable</label>
                                    <input type="text" name="vilresp" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Code postal responsable  </label>
                                    <input type="text" name="cpresp" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Téléphone responsable</label>
                                    <input type="text" name="telresp" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Email responsable</label>
                                    <input type="email" name="emailresp" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Assurance</label>
                                    <input type="text" name="assurance" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Galop</label>
                                    <input type="text" id="libgalop" class="form-control" onkeyup="autocompletGalopajout()" required>
                                    <input type="hidden" id="id_galop" name="idgalop">
                                    <ul id="nom_list_galop_id"></ul>
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
            <?php foreach($cavaliersList as $c): ?>
                <!-- Modal Modification -->
                <div class="modal fade" id="modifModal<?php echo $c['idcava']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Modifier le cavalier</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <form action="../traitement/traitement.cavaliers.php" method="post">
                                <div class="modal-body">

                                    <input type="hidden" name="idcava" value="<?php echo $c['idcava']; ?>">

                                    <div class="form-group">
                                        <label>Nom cavalier</label>
                                        <input type="text" name="nomcava" class="form-control" value="<?php echo $c['nomcava']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Prénom cavalier</label>
                                        <input type="text" name="prenomcava" class="form-control" value="<?php echo $c['prenomcava']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Date de naissance</label>
                                        <input type="date" name="datenacava" class="form-control" value="<?php echo $c['datenacava']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Numéro de licence</label>
                                        <input type="text" name="numlic" class="form-control" value="<?php echo $c['numlic']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Nom responsable</label>
                                        <input type="text" name="nomresp" class="form-control" value="<?php echo $c['nomresp']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Prénom responsable</label>
                                        <input type="text" name="prenomresp" class="form-control" value="<?php echo $c['prenomresp']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Rue responsable</label>
                                        <input type="text" name="rueresp" class="form-control" value="<?php echo $c['rueresp']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Ville responsable</label>
                                        <input type="text" name="vilresp" class="form-control" value="<?php echo $c['vilresp']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Code postal responsable</label>
                                        <input type="text" name="cpresp" class="form-control" value="<?php echo $c['cpresp']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Téléphone responsable</label>
                                        <input type="text" name="telresp" class="form-control" value="<?php echo $c['telresp']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Email responsable</label>
                                        <input type="email" name="emailresp" class="form-control" value="<?php echo $c['emailresp']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" value="<?php echo $c['password']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Assurance</label>
                                        <input type="text" name="assurance" class="form-control" value="<?php echo $c['assurance']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Galop</label>
                                        <input type="text" id="libgalop<?php echo $c['idcava']; ?>" class="form-control" 
                                               value="<?php echo $cavalier->CavaliersGalop($c['idgalop']); ?>" 
                                               onkeyup="autocompletGalop(<?php echo $c['idcava']; ?>)" required>

                                        <input type="hidden" id="id_galop<?php echo $c['idcava']; ?>" name="idgalop" value="<?php echo $c['idgalop']; ?>">
                                        
                                        <ul id="nom_list_galop_id<?php echo $c['idcava']; ?>"></ul>
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
                <div class="modal fade" id="suppModal<?php echo $c['idcava']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Confirmer la suppression</h4>
                                
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                Êtes-vous sûr de vouloir supprimer ce cavalier ?
                            </div>

                            <form action="../traitement/traitement.cavaliers.php" method="post">
                                <input type="hidden" name="idcava" value="<?php echo $c['idcava']; ?>">
                            
                                <div class="modal-footer">
                                    <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                </div>
                            
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Détail -->
                <div class="modal fade" id="detailModal<?php echo $c['idcava']; ?>">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Détails du cavalier</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <div class="detail-group">
                                    <label>ID cavalier :</label>
                                    <p><?php echo $c['idcava']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Nom cavalier :</label>
                                    <p><?php echo $c['nomcava']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Prénom cavalier :</label>
                                    <p><?php echo $c['prenomcava']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Date de naissance :</label>
                                    <p><?php echo date('d/m/Y', strtotime($c['datenacava'])); ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Numéro de licence :</label>
                                    <p><?php echo $c['numlic']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Nom responsable :</label>
                                    <p><?php echo $c['nomresp']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Prénom responsable :</label>
                                    <p><?php echo $c['prenomresp']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Rue responsable :</label>
                                    <p><?php echo $c['rueresp']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Ville responsable :</label>
                                    <p><?php echo $c['vilresp']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Code postal responsable :</label>
                                    <p><?php echo $c['cpresp']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Téléphone responsable :</label>
                                    <p><?php echo $c['telresp']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Email responsable :</label>
                                    <p><?php echo $c['emailresp']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Assurance :</label>
                                    <p><?php echo $c['assurance']; ?></p>
                                </div>

                                <div class="detail-group">
                                    <label>Galop :</label>
                                    <p><?php echo $cavalier->CavaliersGalop($c['idgalop']); ?></p>
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
                    $("#cavalierTable tbody tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>

    </body>
</html>
