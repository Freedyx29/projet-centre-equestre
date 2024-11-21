<?php
include '../class/class.pension.php'; // Assurez-vous que ce chemin est correct

$opension = new Pension();
$reqPension = $opension->PensionALL();

if ($reqPension === null) {
    echo "Erreur : Aucune pension trouvée.";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD pension</title>
        <link rel="stylesheet" href="../css/style_crud.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/script_pension.js"></script>
    </head>
    <body>
        <div class="container">
            <h2>Liste des pensions</h2>

            <div class="center-button">
                <button class="btn-primary" onclick="basculerFormulaire('ajoutForm')">Ajouter une pension</button>
                <button class="btn-primary" id="modifierButton" onclick="basculerFormulaire('modifierForm')" disabled>Modifier une pension</button>
                <button class="btn-danger" id="supprimerButton" onclick="basculerFormulaire('supprimerForm')" disabled>Supprimer une pension</button>
            </div>

            <!-- Formulaire d'ajout -->
            <div class="form-popup" id="ajoutForm">
                <span class="close-btn" onclick="fermerFormulaire('ajoutForm')">&times;</span>
                <form action="../traitement/traitement.pension.php" method="POST" class="form-container">
                    <h3>Ajouter une pension</h3>

                    <div class="form-group">
                        <label for="libpen"><b>Libellé de pension :</b></label>
                        <input type="text" id="libpen" name="libpen" placeholder="Entrer le libellé de pension" required>
                    </div>

                    <div class="form-group">
                        <label for="nomche"><b>Nom du cheval :</b></label>
                        <input type="text" id="nomche" name="nomche" placeholder="Rechercher un cheval" onkeyup="autocompletPensionajout()" required>
                        <ul id="nom_list_pension_id"></ul>
                    </div>

                    <input type="hidden" id="numsire" name="numsire">

                    <div class="button-group">
                        <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
                        <button type="button" class="btn-danger" onclick="fermerFormulaire('ajoutForm')">Fermer</button>
                    </div>
                </form>
            </div>

            <!-- Formulaire de modification -->
            <div class="form-popup" id="modifierForm">
                <span class="close-btn" onclick="fermerFormulaire('modifierForm')">&times;</span>
                <form action="../traitement/traitement.pension.php" method="POST" class="form-container">
                    <h3>Modifier une pension</h3>

                    <input type="hidden" id="modifier_idpen" name="idpen" value="<?php echo $opension->getidpen(); ?>">

                    <div class="form-group">
                        <label for="modifier_libpen"><b>Libellé pension :</b></label>
                        <input type="text" id="modifier_libpen" name="libpen" placeholder="Entrer le libellé pension" value="<?php echo $opension->getlibpen(); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="modifier_nomche"><b>Nom du cheval :</b></label>
                        <input type="text" id="modifier_nomche" name="nomche" placeholder="Rechercher un cheval" onkeyup="autocompletPensionModif()" value="<?php echo $opension->PensionNumsire($opension->getnumsire()); ?>" required>
                        <ul id="modifier_nom_list_pension_id"></ul>
                    </div>
                    
                    <input type="hidden" id="modifier_numsire" name="numsire" value="<?php echo $opension->getnumsire(); ?>">
                    
                    <div class="button-group">
                        <button type="submit" name="modifier" class="btn-primary">Modifier</button>
                        <button type="button" class="btn-danger" onclick="fermerFormulaire('modifierForm')">Fermer</button>
                    </div>
                </form>
            </div>

            <!-- Formulaire de suppression -->
            <div class="form-popup" id="supprimerForm">
                <span class="close-btn" onclick="fermerFormulaire('supprimerForm')">&times;</span>
                <form action="../traitement/traitement.pension.php" method="POST" class="form-container">
                    <h3>Supprimer une pension</h3>
                    <input type="hidden" id="supprimer_idpen" name="idpen">
                    <div class="button-group">
                        <button type="submit" name="supprimer" class="btn-danger">Supprimer</button>
                        <button type="button" class="btn-primary" onclick="fermerFormulaire('supprimerForm')">Fermer</button>
                    </div>
                </form>
            </div>


            

            <!-- Tableau des pensions -->
            <table id="pensionTable" class="display">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>ID</th>
                        <th>Libellé pension</th>
                        <th>Nom cheval</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reqPension as $pension) {
                        if ($pension['supprime'] == '0') {
                    ?>
                    <tr>
                        <td><input type="radio" class="select-pension" 
                            data-idpen="<?= htmlspecialchars($pension['idpen']) ?>" 
                            data-libpen="<?= htmlspecialchars($pension['libpen']) ?>" 
                            data-numsire="<?= htmlspecialchars($pension['numsire']) ?>"
                            data-nomche="<?= htmlspecialchars($opension->PensionNumsire($pension['numsire'])) ?>">
                        </td>
                        <td><?= htmlspecialchars($pension['idpen']) ?></td>
                        <td><?= htmlspecialchars($pension['libpen']) ?></td>
                        <td><?= htmlspecialchars($opension->PensionNumsire($pension['numsire'])) ?></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            $(document).ready(function() {
    // Initialiser DataTable
    if ($.fn.DataTable.isDataTable('#pensionTable')) {
        $('#pensionTable').DataTable().destroy();
    }

    $('#pensionTable').DataTable({
        "language": {
            "search": "Rechercher",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "lengthMenu": "Afficher _MENU_ entrées",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            }
        }
    });

    // Quand une pension est sélectionné
    $(document).on('click', '.select-pension', function() {
        // On désactive les boutons au début, puis on les active si une pension est sélectionné
        $('#modifierButton').prop('disabled', true);
        $('#supprimerButton').prop('disabled', true);

        var idpen = $(this).data('idpen');
        var libpen = $(this).data('libpen');
        var numsire = $(this).data('numsire');
        var nomche = $(this).data('nomche');

        // Si une pension est sélectionné, on remplit les champs
        $('#modifier_idpen').val(idpen);
        $('#modifier_libpen').val(libpen);
        $('#modifier_numsire').val(numsire);
        $('#modifier_nomche').val(nomche); // Charger le nom du cheval
        $('#supprimer_idpen').val(idpen);

        // Activer les boutons "Modifier" et "Supprimer"
        $('#modifierButton').prop('disabled', false);
        $('#supprimerButton').prop('disabled', false);
    });
});

// Fonction pour basculer l'affichage des formulaires
function basculerFormulaire(formId) {
    document.getElementById('ajoutForm').style.display = 'none';
    document.getElementById('modifierForm').style.display = 'none';
    document.getElementById('supprimerForm').style.display = 'none';
    document.getElementById(formId).style.display = 'block';
}

// Fonction pour fermer un formulaire
function fermerFormulaire(formId) {
    document.getElementById(formId).style.display = 'none';
}

// Fonction pour ouvrir le popup
function ouvrirFormulaire(formId) {
    const overlay = document.createElement('div');
    overlay.className = 'popup-overlay';
    document.body.appendChild(overlay);
    
    const form = document.getElementById(formId);
    overlay.style.display = 'block';
    form.style.display = 'block';
    
    // Déclencher l'animation
    setTimeout(() => {
        form.classList.add('showing');
    }, 10);
}

// Fonction pour fermer le popup
function fermerFormulaire(formId) {
    const form = document.getElementById(formId);
    const overlay = document.querySelector('.popup-overlay');
    
    form.classList.remove('showing');
    form.classList.add('hiding');
    
    // Attendre la fin de l'animation avant de cacher
    setTimeout(() => {
        form.style.display = 'none';
        form.classList.remove('hiding');
        overlay.remove();
    }, 300);
}


        </script>

    </body>
    </html>
    <?php
}
?>
