<?php
include_once '../class/class.cours.php';
include_once '../include/haut.inc.php';
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
    <script src="../js/script_cours.cavaliers.js"></script>
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

        <!-- Bouton Ajouter et Générer PDF -->
    <div class="row mb-3">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutModal">
                Ajouter un cours
            </button>
            <!-- Bouton "Afficher le PDF" avec une couleur légèrement plus foncée -->
            <a href="../classpdf/classpdfcours.php" class="btn" style="background-color: #B88C47; color: white; text-decoration: none; border-radius: 6px; padding: 10px 20px; font-size: 16px; font-family: Arial, sans-serif "target="_blank";">
                📋 Afficher le PDF
            </a>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajouter un cours</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form action="../traitement/traitement.cours.php" method="post">
                        <div class="modal-body">
                            <!-- Première partie : informations du cours -->
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

                            <!-- Deuxième partie : ajout des cavaliers -->
                            <hr>
                            <h5>Ajouter des cavaliers</h5>
                            <div id="cavaliersContainer">
                                <div class="cavalier-input mb-3">
                                    <div class="form-group">
                                        <label>Cavalier</label>
                                        <input type="text" id="nomcava" name="nomcava[]" class="form-control" onkeyup="autocompletCoursCavaajout()" placeholder="Rechercher un cavalier...">
                                        <input type="hidden" id="id_cava" name="cavaliers[]">
                                        <ul id="nom_list_cours_cava_id" class="cavalier-suggestions"></ul>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm" id="addCavalierBtn">
                                + Ajouter un autre cavalier
                            </button>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="ajouter" class="btn btn-primary">Enregistrer</button>
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
                <div class="modal-dialog modal-lg">
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

                                <!-- Section des cavaliers -->
                                <hr>
                                <h5 class="mb-3">Cavaliers inscrits</h5>
                                <div id="cavaliersContainer<?php echo $c['idcours']; ?>">
                                    <?php 
                                    $cavaliers = $cours->getCavaliersForCours($c['idcours']);
                                    foreach ($cavaliers as $index => $cavalier): 
                                    ?>
                                    <div class="cavalier-input mb-3">
                                        <div class="form-group position-relative">
                                            <label>Cavalier <?php echo $index + 1; ?></label>
                                            <input type="text" 
                                                   id="nomcava<?php echo $c['idcours']; ?>_<?php echo $index; ?>" 
                                                   name="nomcava[]" 
                                                   class="form-control" 
                                                   value="<?php echo htmlspecialchars($cavalier['nomcava']); ?>"
                                                   onkeyup="autocompletCoursCava('<?php echo $c['idcours']; ?>_<?php echo $index; ?>')">
                                            <input type="hidden" 
                                                   id="id_cava<?php echo $c['idcours']; ?>_<?php echo $index; ?>" 
                                                   name="cavaliers[]" 
                                                   value="<?php echo $cavalier['idcava']; ?>">
                                            <ul id="nom_list_cours_cava_id<?php echo $c['idcours']; ?>_<?php echo $index; ?>" 
                                                class="autocomplete-list"></ul>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-brown" 
                                        onclick="ajouterCavalier('<?php echo $c['idcours']; ?>', '<?php echo count($cavaliers); ?>')">
                                    <i class="fas fa-plus"></i> Ajouter un cavalier
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="modifier" class="btn btn-primary">Enregistrer</button>
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

                            <div class="detail-group">
                                <label>Cavaliers inscrits :</label>
                                <div class="cavaliers-list">
                                    <?php 
                                    $cavaliers = $cours->getCavaliersForCours($c['idcours']);
                                    if (!empty($cavaliers)) {
                                        foreach ($cavaliers as $cavalier) {
                                            echo '<div class="cavalier-item">' . htmlspecialchars($cavalier['nomcava']) . '</div>';
                                        }
                                    } else {
                                        echo '<div class="cavalier-item">Aucun cavalier inscrit</div>';
                                    }
                                    ?>
                                </div>
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
    var $rows = $("#coursTable tbody tr");
    var page = 1;
    var limit = 7;
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
            $("#coursTable tbody tr").each(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        }
    });

    // Ajoute les boutons et le numéro de page
    $("#coursTable").after(`
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

<style>
.cavalier-suggestions {
    position: absolute;
    background: white;
    border: 1px solid #ddd;
    border-top: none;
    max-height: 150px;
    overflow-y: auto;
    width: 100%;
    z-index: 1000;
    list-style: none;
    padding: 0;
    margin: 0;
}

.cavalier-suggestions li {
    padding: 8px 12px;
    cursor: pointer;
}

.cavalier-suggestions li:hover {
    background-color: #f0f0f0;
}
</style>

<script>
$(document).ready(function() {
    let cavalierCount = 0;
    
    $('#addCavalierBtn').click(function() {
        cavalierCount++;
        const newInput = `
            <div class="cavalier-input mb-3">
                <div class="form-group">
                    <label>Cavalier</label>
                    <input type="text" id="nomcava${cavalierCount}" name="nomcava[]" class="form-control" onkeyup="autocompletCoursCava(${cavalierCount})" placeholder="Rechercher un cavalier...">
                    <input type="hidden" id="id_cava${cavalierCount}" name="cavaliers[]">
                    <ul id="nom_list_cours_cava_id${cavalierCount}" class="cavalier-suggestions"></ul>
                </div>
            </div>
        `;
        $('#cavaliersContainer').append(newInput);
    });
});
</script>

<script>
function ajouterCavalier(idcours, index) {
    const newIndex = parseInt(index) + 1;
    const newInput = `
        <div class="cavalier-input mb-3">
            <div class="form-group position-relative">
                <label>Cavalier ${newIndex + 1}</label>
                <input type="text" 
                       id="nomcava${idcours}_${newIndex}" 
                       name="nomcava[]" 
                       class="form-control" 
                       onkeyup="autocompletCoursCava('${idcours}_${newIndex}')">
                <input type="hidden" 
                       id="id_cava${idcours}_${newIndex}" 
                       name="cavaliers[]">
                <ul id="nom_list_cours_cava_id${idcours}_${newIndex}" 
                    class="autocomplete-list"></ul>
            </div>
        </div>
    `;
    $(`#cavaliersContainer${idcours}`).append(newInput);
}
</script>

<script>
$(document).ready(function() {
    // Délégation d'événement pour gérer les clics sur les suggestions
    $(document).on('click', '.autocomplete-list li', function() {
        const id = $(this).closest('.cavalier-input').find('input[type="text"]').attr('id').replace('nomcava', '');
        const nom = $(this).text();
        const idCava = $(this).data('id');
        
        set_item_cava(nom, id, idCava);
    });
});
</script>
</body>
</html>
