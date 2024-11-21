<?php
include '../class/class.cavaliers.php'; // Assurez-vous que ce chemin est correct

$ocavaliers = new Cavaliers();
$reqCavalier = $ocavaliers->CavaliersALL();

if ($reqCavalier === null) {
    echo "Erreur : Aucun cavalier trouvé.";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des Cavaliers</title>
        <link rel="stylesheet" href="../css/style_crud.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="../js/script_cavaliers.js"></script>
    </head>
    <body>
        <div class="container">

            <h2>Listes des Cavaliers</h2>

            <div class="center-button">
                <button class="btn-primary" onclick="basculerFormulaire('ajoutForm')">Ajouter un cavalier</button>
                <button class="btn-primary" id="modifierButton" onclick="basculerFormulaire('modifierForm')" disabled>Modifier un cavalier</button>
                <button class="btn-danger" id="supprimerButton" onclick="basculerFormulaire('supprimerForm')" disabled>Supprimer un cavalier</button>
                <button class="btn-info" id="ficheDetailButton" onclick="afficherFicheDetail()" disabled>Fiche détail</button>
            </div>

            <!-- Formulaire d'ajout -->
            <div class="form-popup" id="ajoutForm">
                <span class="close-btn" onclick="fermerFormulaire('ajoutForm')">&times;</span>
                <form action="../traitement/traitement.cavaliers.php" method="POST" class="form-container">
                    <h3>Ajouter un cavalier</h3>
                    <div class="form-group">
                        <label for="nomcava"><b>Nom :</b></label>
                        <input type="text" id="nomcava" name="nomcava" placeholder="Entrer le nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenomcava"><b>Prénom :</b></label>
                        <input type="text" id="prenomcava" name="prenomcava" placeholder="Entrer le prénom" required>
                    </div>
                    <div class="form-group">
                        <label for="datenacava"><b>Date de naissance :</b></label>
                        <input type="date" id="datenacava" name="datenacava" required>
                    </div>
                    <div class="form-group">
                        <label for="numlic"><b>Numéro de licence :</b></label>
                        <input type="text" id="numlic" name="numlic" placeholder="Entrer le numéro de licence" required>
                    </div>
                    <div class="form-group">
                        <label for="photo"><b>Photo :</b></label>
                        <input type="text" id="photo" name="photo" placeholder="Entrer le lien de la photo" required>
                    </div>
                    <div class="form-group">
                        <label for="nomresp"><b>Nom du responsable :</b></label>
                        <input type="text" id="nomresp" name="nomresp" placeholder="Entrer le nom du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="prenomresp"><b>Prénom du responsable :</b></label>
                        <input type="text" id="prenomresp" name="prenomresp" placeholder="Entrer le prénom du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="rueresp"><b>Adresse du responsable :</b></label>
                        <input type="text" id="rueresp" name="rueresp" placeholder="Entrer l'adresse du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="vilresp"><b>Ville du responsable :</b></label>
                        <input type="text" id="vilresp" name="vilresp" placeholder="Entrer la ville du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="cpresp"><b>Code postal du responsable :</b></label>
                        <input type="text" id="cpresp" name="cpresp" placeholder="Entrer le code postal du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="telresp"><b>Téléphone du responsable :</b></label>
                        <input type="text" id="telresp" name="telresp" placeholder="Entrer le téléphone du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="emailresp"><b>Email du responsable :</b></label>
                        <input type="email" id="emailresp" name="emailresp" placeholder="Entrer l'email du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="assurance"><b>Assurance :</b></label>
                        <input type="text" id="assurance" name="assurance" placeholder="Entrer l'assurance" required>
                    </div>
                    <div class="form-group">
                        <label for="motdepasse"><b>Mot de passe :</b></label>
                        <input type="password" id="motdepasse" name="motdepasse" placeholder="Entrer le mot de passe" required>
                    </div>
                    <div class="form-group">
                        <label for="libgalop"><b>Galop :</b></label>
                        <input type="text" id="libgalop" name="libgalop" placeholder="Rechercher un galop" onkeyup="autocompletGalopajout()" required>
                        <ul id="nom_list_galop_id"></ul>
                    </div>
                    <input type="hidden" id="idgalop" name="idgalop">
                    <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
                </form>
            </div>

            <!-- Formulaire de modification -->
            <div class="form-popup" id="modifierForm">
                <span class="close-btn" onclick="fermerFormulaire('modifierForm')">&times;</span>
                <form action="../traitement/traitement.cavaliers.php" method="POST" class="form-container">
                    <h3>Modifier un cavalier</h3>
                    <input type="hidden" id="modifier_idcava" name="idcava">
                    <div class="form-group">
                        <label for="modifier_nomcava"><b>Nom :</b></label>
                        <input type="text" id="modifier_nomcava" name="nomcava" placeholder="Entrer le nom" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_prenomcava"><b>Prénom :</b></label>
                        <input type="text" id="modifier_prenomcava" name="prenomcava" placeholder="Entrer le prénom" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_datenacava"><b>Date de naissance :</b></label>
                        <input type="date" id="modifier_datenacava" name="datenacava" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_numlic"><b>Numéro de licence :</b></label>
                        <input type="text" id="modifier_numlic" name="numlic" placeholder="Entrer le numéro de licence" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_photo"><b>Photo :</b></label>
                        <input type="text" id="modifier_photo" name="photo" placeholder="Entrer le lien de la photo" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_nomresp"><b>Nom du responsable :</b></label>
                        <input type="text" id="modifier_nomresp" name="nomresp" placeholder="Entrer le nom du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_prenomresp"><b>Prénom du responsable :</b></label>
                        <input type="text" id="modifier_prenomresp" name="prenomresp" placeholder="Entrer le prénom du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_rueresp"><b>Adresse du responsable :</b></label>
                        <input type="text" id="modifier_rueresp" name="rueresp" placeholder="Entrer l'adresse du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_vilresp"><b>Ville du responsable :</b></label>
                        <input type="text" id="modifier_vilresp" name="vilresp" placeholder="Entrer la ville du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_cpresp"><b>Code postal du responsable :</b></label>
                        <input type="text" id="modifier_cpresp" name="cpresp" placeholder="Entrer le code postal du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_telresp"><b>Téléphone du responsable :</b></label>
                        <input type="text" id="modifier_telresp" name="telresp" placeholder="Entrer le téléphone du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_emailresp"><b>Email du responsable :</b></label>
                        <input type="email" id="modifier_emailresp" name="emailresp" placeholder="Entrer l'email du responsable" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_assurance"><b>Assurance :</b></label>
                        <input type="text" id="modifier_assurance" name="assurance" placeholder="Entrer l'assurance" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_motdepasse"><b>Mot de passe :</b></label>
                        <input type="password" id="modifier_motdepasse" name="motdepasse" placeholder="Entrer le mot de passe (laisser vide pour ne pas modifier)" required>
                    </div>
                    <div class="form-group">
                        <label for="modifier_libgalop"><b>Galop :</b></label>
                        <input type="text" id="modifier_libgalop" name="libgalop" placeholder="Rechercher un galop" onkeyup="autocompletGalopModif()" required>
                        <ul id="modifier_nom_list_galop_id"></ul>
                    </div>
                    <input type="hidden" id="modifier_idgalop" name="idgalop">
                    <button type="submit" name="modifier" class="btn-primary">Modifier</button>
                </form>
            </div>

            <!-- Formulaire de suppression -->
            <div class="form-popup" id="supprimerForm">
                <span class="close-btn" onclick="fermerFormulaire('supprimerForm')">&times;</span>
                <form action="../traitement/traitement.cavaliers.php" method="POST" class="form-container">
                    <h3>Supprimer un cavalier</h3>
                    <input type="hidden" id="supprimer_idcava" name="idcava">
                    <button type="submit" name="supprimer" class="btn-danger">Supprimer</button>
                </form>
            </div>

            <!-- Pop-up pour la fiche détail -->
            <div class="form-popup" id="ficheDetailPopup">
                <span class="close-btn" onclick="fermerFormulaire('ficheDetailPopup')">&times;</span>
                <div class="form-container">
                    <h3>Fiche détail du cavalier</h3>
                    <div class="form-group">
                        <label><b>ID :</b></label>
                        <span id="fiche_idcava"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Nom :</b></label>
                        <span id="fiche_nomcava"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Prénom :</b></label>
                        <span id="fiche_prenomcava"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Date de naissance :</b></label>
                        <span id="fiche_datenacava"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Numéro de licence :</b></label>
                        <span id="fiche_numlic"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Photo :</b></label>
                        <span id="fiche_photo"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Nom du responsable :</b></label>
                        <span id="fiche_nomresp"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Prénom du responsable :</b></label>
                        <span id="fiche_prenomresp"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Adresse du responsable :</b></label>
                        <span id="fiche_rueresp"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Ville du responsable :</b></label>
                        <span id="fiche_vilresp"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Code postal du responsable :</b></label>
                        <span id="fiche_cpresp"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Téléphone du responsable :</b></label>
                        <span id="fiche_telresp"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Email du responsable :</b></label>
                        <span id="fiche_emailresp"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Assurance :</b></label>
                        <span id="fiche_assurance"></span>
                    </div>
                    <div class="form-group">
                        <label><b>Galop :</b></label>
                        <span id="fiche_libgalop"></span>
                    </div>
                </div>
            </div>

            <!-- Tableau des cavaliers -->
            <h2>Liste des Cavaliers</h2>
            <table id="cavalierTable" class="display">
                <thead>
                    <tr>
                        <th class="col-select">Sélectionner</th>
                        <th class="col-id">ID</th>
                        <th class="col-nom">Nom</th>
                        <th class="col-prenom">Prénom</th>
                        <th class="col-date-naissance">Date de naissance</th>
                        <th class="col-numlic">Numéro de licence</th>
                        <th class="col-assurance">Assurance</th>
                        <th class="col-nomresp">Nom du responsable</th>
                        <th class="col-galop">Galop</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reqCavalier as $cavalier) {
                        if ($cavalier['supprime'] == '0') {
                    ?>
                    <tr>
                        <td class="col-select">
                            <input type="radio" class="select-cavalier" name="cavalier"
                                data-idcava="<?= htmlspecialchars($cavalier['idcava']) ?>"
                                data-nomcava="<?= htmlspecialchars($cavalier['nomcava']) ?>"
                                data-prenomcava="<?= htmlspecialchars($cavalier['prenomcava']) ?>"
                                data-datenacava="<?= htmlspecialchars($cavalier['datenacava']) ?>"
                                data-numlic="<?= htmlspecialchars($cavalier['numlic']) ?>"
                                data-photo="<?= htmlspecialchars($cavalier['photo']) ?>"
                                data-nomresp="<?= htmlspecialchars($cavalier['nomresp']) ?>"
                                data-prenomresp="<?= htmlspecialchars($cavalier['prenomresp']) ?>"
                                data-rueresp="<?= htmlspecialchars($cavalier['rueresp']) ?>"
                                data-vilresp="<?= htmlspecialchars($cavalier['vilresp']) ?>"
                                data-cpresp="<?= htmlspecialchars($cavalier['cpresp']) ?>"
                                data-telresp="<?= htmlspecialchars($cavalier['telresp']) ?>"
                                data-emailresp="<?= htmlspecialchars($cavalier['emailresp']) ?>"
                                data-assurance="<?= htmlspecialchars($cavalier['assurance']) ?>"
                                data-idgalop="<?= htmlspecialchars($cavalier['idgalop']) ?>"
                                data-libgalop="<?= htmlspecialchars($ocavaliers->CavaliersGalop($cavalier['idgalop'])) ?>">
                        </td>
                        <td class="col-id"><?= htmlspecialchars($cavalier['idcava']) ?></td>
                        <td class="col-nom"><?= htmlspecialchars($cavalier['nomcava']) ?></td>
                        <td class="col-prenom"><?= htmlspecialchars($cavalier['prenomcava']) ?></td>
                        <td class="col-date-naissance"><?= htmlspecialchars($cavalier['datenacava']) ?></td>
                        <td class="col-numlic"><?= htmlspecialchars($cavalier['numlic']) ?></td>
                        <td class="col-assurance"><?= htmlspecialchars($cavalier['assurance']) ?></td>
                        <td class="col-nomresp"><?= htmlspecialchars($cavalier['nomresp']) ?></td>
                        <td class="col-galop"><?= htmlspecialchars($ocavaliers->CavaliersGalop($cavalier['idgalop'])) ?></td>
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
                if ($.fn.DataTable.isDataTable('#cavalierTable')) {
                    $('#cavalierTable').DataTable().destroy();
                }

                $('#cavalierTable').DataTable({
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

                // Quand un cavalier est sélectionné
                $(document).on('click', '.select-cavalier', function() {
                    // On désactive les boutons au début, puis on les active si un cavalier est sélectionné
                    $('#modifierButton').prop('disabled', true);
                    $('#supprimerButton').prop('disabled', true);
                    $('#ficheDetailButton').prop('disabled', true);

                    var idcava = $(this).data('idcava');
                    var nomcava = $(this).data('nomcava');
                    var prenomcava = $(this).data('prenomcava');
                    var datenacava = $(this).data('datenacava');
                    var numlic = $(this).data('numlic');
                    var photo = $(this).data('photo');
                    var nomresp = $(this).data('nomresp');
                    var prenomresp = $(this).data('prenomresp');
                    var rueresp = $(this).data('rueresp');
                    var vilresp = $(this).data('vilresp');
                    var cpresp = $(this).data('cpresp');
                    var telresp = $(this).data('telresp');
                    var emailresp = $(this).data('emailresp');
                    var assurance = $(this).data('assurance');
                    var idgalop = $(this).data('idgalop');
                    var libgalop = $(this).data('libgalop');

                    // Si un cavalier est sélectionné, on remplit les champs
                    $('#modifier_idcava').val(idcava);
                    $('#modifier_nomcava').val(nomcava);
                    $('#modifier_prenomcava').val(prenomcava);
                    $('#modifier_datenacava').val(datenacava);
                    $('#modifier_numlic').val(numlic);
                    $('#modifier_photo').val(photo);
                    $('#modifier_nomresp').val(nomresp);
                    $('#modifier_prenomresp').val(prenomresp);
                    $('#modifier_rueresp').val(rueresp);
                    $('#modifier_vilresp').val(vilresp);
                    $('#modifier_cpresp').val(cpresp);
                    $('#modifier_telresp').val(telresp);
                    $('#modifier_emailresp').val(emailresp);
                    $('#modifier_assurance').val(assurance);
                    $('#modifier_idgalop').val(idgalop);
                    $('#modifier_libgalop').val(libgalop); // Charger le libgalop
                    $('#supprimer_idcava').val(idcava);

                    // Activer les boutons "Modifier" et "Supprimer"
                    $('#modifierButton').prop('disabled', false);
                    $('#supprimerButton').prop('disabled', false);
                    $('#ficheDetailButton').prop('disabled', false);
                });
            });

            // Fonction pour basculer l'affichage des formulaires
            function basculerFormulaire(formId) {
                document.getElementById('ajoutForm').style.display = 'none';
                document.getElementById('modifierForm').style.display = 'none';
                document.getElementById('supprimerForm').style.display = 'none';
                document.getElementById('ficheDetailPopup').style.display = 'none';
                document.getElementById(formId).style.display = 'block';
            }

            // Fonction pour fermer un formulaire
            function fermerFormulaire(formId) {
                document.getElementById(formId).style.display = 'none';
            }

            // Fonction pour afficher la fiche détail
            function afficherFicheDetail() {
                var idcava = $('#modifier_idcava').val();
                var nomcava = $('#modifier_nomcava').val();
                var prenomcava = $('#modifier_prenomcava').val();
                var datenacava = $('#modifier_datenacava').val();
                var numlic = $('#modifier_numlic').val();
                var photo = $('#modifier_photo').val();
                var nomresp = $('#modifier_nomresp').val();
                var prenomresp = $('#modifier_prenomresp').val();
                var rueresp = $('#modifier_rueresp').val();
                var vilresp = $('#modifier_vilresp').val();
                var cpresp = $('#modifier_cpresp').val();
                var telresp = $('#modifier_telresp').val();
                var emailresp = $('#modifier_emailresp').val();
                var assurance = $('#modifier_assurance').val();
                var libgalop = $('#modifier_libgalop').val();

                // Remplir les champs de la fiche détail
                $('#fiche_idcava').text(idcava);
                $('#fiche_nomcava').text(nomcava);
                $('#fiche_prenomcava').text(prenomcava);
                $('#fiche_datenacava').text(datenacava);
                $('#fiche_numlic').text(numlic);
                $('#fiche_photo').text(photo);
                $('#fiche_nomresp').text(nomresp);
                $('#fiche_prenomresp').text(prenomresp);
                $('#fiche_rueresp').text(rueresp);
                $('#fiche_vilresp').text(vilresp);
                $('#fiche_cpresp').text(cpresp);
                $('#fiche_telresp').text(telresp);
                $('#fiche_emailresp').text(emailresp);
                $('#fiche_assurance').text(assurance);
                $('#fiche_libgalop').text(libgalop);

                // Afficher le pop-up
                basculerFormulaire('ficheDetailPopup');
            }
        </script>

    </body>
    </html>
    <?php
}
?>
