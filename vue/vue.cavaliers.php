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
            <h2>Liste des Cavaliers</h2>

            <div class="center-button">
                <button class="btn-primary" onclick="basculerFormulaire('ajoutForm')">Ajouter un cavalier</button>
                <button class="btn-primary" id="modifierButton" onclick="verifierSelection('modifierForm')" disabled>Modifier un cavalier</button>
                <button class="btn-danger" id="supprimerButton" onclick="verifierSelection('supprimerForm')" disabled>Supprimer un cavalier</button>
                <button class="btn-info" id="detailsButton" onclick="afficherDetails()" disabled>Plus de détails</button>
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

            <!-- Formulaire de détails -->
            <div class="form-popup" id="detailsForm">
                <span class="close-btn" onclick="fermerFormulaire('detailsForm')">&times;</span>
                <div class="form-container">
                    <h3>Détails du cavalier</h3>
                    <div class="form-group">
                        <label for="details_nomcava"><b>Nom :</b></label>
                        <input type="text" id="details_nomcava" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_prenomcava"><b>Prénom :</b></label>
                        <input type="text" id="details_prenomcava" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_datenacava"><b>Date de naissance :</b></label>
                        <input type="text" id="details_datenacava" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_numlic"><b>Numéro de licence :</b></label>
                        <input type="text" id="details_numlic" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_photo"><b>Photo :</b></label>
                        <input type="text" id="details_photo" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_nomresp"><b>Nom du responsable :</b></label>
                        <input type="text" id="details_nomresp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_prenomresp"><b>Prénom du responsable :</b></label>
                        <input type="text" id="details_prenomresp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_rueresp"><b>Adresse du responsable :</b></label>
                        <input type="text" id="details_rueresp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_vilresp"><b>Ville du responsable :</b></label>
                        <input type="text" id="details_vilresp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_cpresp"><b>Code postal du responsable :</b></label>
                        <input type="text" id="details_cpresp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_telresp"><b>Téléphone du responsable :</b></label>
                        <input type="text" id="details_telresp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_emailresp"><b>Email du responsable :</b></label>
                        <input type="text" id="details_emailresp" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_assurance"><b>Assurance :</b></label>
                        <input type="text" id="details_assurance" readonly>
                    </div>
                    <div class="form-group">
                        <label for="details_libgalop"><b>Galop :</b></label>
                        <input type="text" id="details_libgalop" readonly>
                    </div>
                </div>
            </div>

            <!-- Tableau des cavaliers -->
            <h2>Liste des Cavaliers</h2>
            <table id="cavalierTable" class="display">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Numéro de licence</th>
                        <th>Photo</th>
                        <th>Assurance</th>
                        <th>Galop</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($reqCavalier as $cavalier) {
                        if ($cavalier['supprime'] == '0') {
                    ?>
                    <tr>
                        <td>
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
                        <td><?= htmlspecialchars($cavalier['nomcava']) ?></td>
                        <td><?= htmlspecialchars($cavalier['prenomcava']) ?></td>
                        <td><?= htmlspecialchars($cavalier['datenacava']) ?></td>
                        <td><?= htmlspecialchars($cavalier['numlic']) ?></td>
                        <td><?= htmlspecialchars($cavalier['photo']) ?></td>
                        <td><?= htmlspecialchars($cavalier['assurance']) ?></td>
                        <td><?= htmlspecialchars($ocavaliers->CavaliersGalop($cavalier['idgalop'])) ?></td>
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
                    $('#detailsButton').prop('disabled', true);

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

                    // Remplir les champs de détails
                    $('#details_nomcava').val(nomcava);
                    $('#details_prenomcava').val(prenomcava);
                    $('#details_datenacava').val(datenacava);
                    $('#details_numlic').val(numlic);
                    $('#details_photo').val(photo);
                    $('#details_nomresp').val(nomresp);
                    $('#details_prenomresp').val(prenomresp);
                    $('#details_rueresp').val(rueresp);
                    $('#details_vilresp').val(vilresp);
                    $('#details_cpresp').val(cpresp);
                    $('#details_telresp').val(telresp);
                    $('#details_emailresp').val(emailresp);
                    $('#details_assurance').val(assurance);
                    $('#details_libgalop').val(libgalop); // Charger le libgalop

                    // Activer les boutons "Modifier", "Supprimer" et "Plus de détails"
                    $('#modifierButton').prop('disabled', false);
                    $('#supprimerButton').prop('disabled', false);
                    $('#detailsButton').prop('disabled', false);
                });
            });

            // Fonction pour vérifier la sélection
            function verifierSelection(formId) {
                var selectedCavalier = $('input[name="cavalier"]:checked').length;
                if (selectedCavalier === 0) {
                    alert('Veuillez sélectionner un cavalier.');
                } else {
                    basculerFormulaire(formId);
                }
            }

            // Fonction pour basculer l'affichage des formulaires
            function basculerFormulaire(formId) {
                document.getElementById('ajoutForm').style.display = 'none';
                document.getElementById('modifierForm').style.display = 'none';
                document.getElementById('supprimerForm').style.display = 'none';
                document.getElementById('detailsForm').style.display = 'none';
                document.getElementById(formId).style.display = 'block';
            }

            // Fonction pour fermer un formulaire
            function fermerFormulaire(formId) {
                document.getElementById(formId).style.display = 'none';
            }

            // Fonction pour afficher les détails
            function afficherDetails() {
                basculerFormulaire('detailsForm');
            }
        </script>

    </body>
    </html>
    <?php
}
?>
