<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduti'])) {
    $current_page = urlencode($_SERVER['PHP_SELF']);
    header("Location: ../vue/vue.index.php?redirect_to=" . $current_page);
    exit();
}

include_once '../include/haut.inc.php';
include_once '../class/class.inscrit.php';
$inscrit = new Inscrit();
$listeInscrits = $inscrit->InscritALL();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestion des Inscriptions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style_crud.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script_inscrit.cava.js"></script>
    <script src="../js/script_inscrit.cours.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Liste des Inscriptions</h2>

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
                    Ajouter une inscription
                </button>
                <!-- Bouton "Afficher le PDF" avec une couleur légèrement plus foncée -->
                <a href="../classpdf/classpdfinscrit.php" class="btn" style="background-color: #B88C47; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-size: 16px; font-family: Arial, sans-serif;" target="_blank">
                    📋 Afficher le PDF
                </a>
            </div>
            <div class="col-md-6">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
            </div>
        </div>


        <!-- Tableau des inscriptions -->
        <table class="table table-striped" id="inscritTable">
            <thead>
                <tr>
                    <th>Cavaliers</th>
                    <th>Cours</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listeInscrits as $i):
                if($i['supprime'] != '1'): ?>
                <tr>
                    <td><?php echo $inscrit->InscritCava($i['refidcava']); ?></td>
                    <td><?php echo $inscrit->InscritCours($i['refidcours']); ?></td>
                    <td>
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal<?php echo $i['refidcava'] . '_' . $i['refidcours']; ?>">
                            Détail
                        </button>
                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modifModal<?php echo $i['refidcava'] . '_' . $i['refidcours']; ?>">
                            Modifier
                        </button>
                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#suppModal<?php echo $i['refidcava'] . '_' . $i['refidcours']; ?>">
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
                        <h4 class="modal-title">Ajouter une inscription</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.inscrit.php" method="post">
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <label>Cavalier</label>
                                <input type="text" id="nomcava" name="nomcava" class="form-control" onkeyup="autocompletInscritCavaajout()" required>
                                <input type="hidden" name="idcava" id="id_cava">
                                <ul id="nom_list_inscrit_cava_id"></ul>
                            </div>

                            <div class="form-group">
                                <label>Cours</label>
                                <input type="text" id="libcours" name="libcours" class="form-control" onkeyup="autocompletInscritCoursajout()" required>
                                <input type="hidden" name="idcours" id="id_cours">
                                <ul id="nom_list_inscrit_cours_id"></ul>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="ajouter" class="btn btn-primary">Ajouter</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Modals Modification et Suppression et Détail -->
        <?php foreach($listeInscrits as $i):
        if($i['supprime'] != '1'): ?>
        <!-- Modal Modification -->
        <div class="modal fade" id="modifModal<?php echo $i['refidcava'] . '_' . $i['refidcours']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Modifier l'inscription</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.inscrit.php" method="post">
                        <div class="modal-body">

                            <input type="hidden" name="refidcava" value="<?php echo $i['refidcava']; ?>">
                            <input type="hidden" name="refidcours" value="<?php echo $i['refidcours']; ?>">

                            <input type="hidden" name="id_cours_first" value="<?php echo $i['refidcours']; ?>">
                            <input type="hidden" name="id_cava_first" value="<?php echo $i['refidcava']; ?>">

                            <div class="form-group">
                                <label>Cavalier</label>
                                <input type="text" 
                                       id="nomcava<?php echo $i['refidcava']; ?>" 
                                       class="form-control"
                                       value="<?php echo $inscrit->InscritCava($i['refidcava']); ?>"
                                       onkeyup="autocompletInscritCava('<?php echo $i['refidcava']; ?>')" 
                                       required>

                                <input type="hidden" name="idcava" 
                                       id="id_cava<?php echo $i['refidcava']; ?>" 
                                       value="<?php echo $i['refidcava']; ?>">

                                <ul id="nom_list_inscrit_cava_id<?php echo $i['refidcava']; ?>"></ul>
                            </div>

                            <div class="form-group">
                                <label>Cours</label>
                                <input type="text" 
                                       id="libcours<?php echo $i['refidcours']; ?>" 
                                       class="form-control"
                                       value="<?php echo $inscrit->InscritCours($i['refidcours']); ?>"
                                       onkeyup="autocompletInscritCours('<?php echo $i['refidcours']; ?>')" 
                                       required>

                                <input type="hidden" name="idcours" 
                                       id="id_cours<?php echo $i['refidcours']; ?>" 
                                       value="<?php echo $i['refidcours']; ?>">

                                <ul id="nom_list_inscrit_cours_id<?php echo $i['refidcours']; ?>"></ul>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Suppression -->
        <div class="modal fade" id="suppModal<?php echo $i['refidcava'] . '_' . $i['refidcours']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmer la suppression</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer cette inscription ?  
                    </div>

                    <form action="../traitement/traitement.inscrit.php" method="post">
                        <input type="hidden" name="refidcava" value="<?php echo $i['refidcava']; ?>">
                        <input type="hidden" name="refidcours" value="<?php echo $i['refidcours']; ?>">

                        <div class="modal-footer">
                            <button type="submit" name="supprimer" class="btn btn-danger">Supprimer</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Détail -->
        <div class="modal fade" id="detailModal<?php echo $i['refidcava'] . '_' . $i['refidcours']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Détails de l'inscription</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="detail-group">
                            <label>Cavalier</label>
                            <p><?php echo $inscrit->InscritCava($i['refidcava']); ?></p>
                        </div>

                        <div class="detail-group">
                            <label>Cours</label>
                            <p><?php echo $inscrit->InscritCours($i['refidcours']); ?></p>
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
    var $rows = $("#inscritTable tbody tr");
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
            $("#inscritTable tbody tr").each(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        }
    });

    // Ajoute les boutons et le numéro de page
    $("#inscritTable").after(`
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
