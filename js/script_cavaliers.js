// Fonction d'autocomplétion pour le formulaire d'ajout
function autocompletGalopajout() {
    var min_length = 1;
    var keyword = $('#libgalop').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.cavaliersajout.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: 0 // Envoie l'index à ajax.cavaliersajout.php pour gérer les résultats
            },
            success: function(data) {
                $('#nom_list_galop_id').show(); // Affiche la liste des résultats
                $('#nom_list_galop_id').html(data); // Remplit la liste avec les résultats
            },
        });
    } else {
        $('#nom_list_galop_id').hide(); // Cache la liste si le texte est trop court
    }
}

// Lors du clic sur un élément de la liste
function set_item_cavalier_ajout(item, id_galop) {
    // Mettre à jour le champ texte libgalop avec la valeur sélectionnée
    $('#libgalop').val(item);
    // Cacher la liste des suggestions après la sélection
    $('#nom_list_galop_id').hide();
    // Mettre à jour le champ caché id_galop avec l'ID du galop sélectionné
    $('#idgalop').val(id_galop);
}

// Fonction d'autocomplétion pour le formulaire de modification
function autocompletGalopModif() {
    var min_length = 1;
    var keyword = $('#modifier_libgalop').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.cavaliers.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: 0 // Envoie l'index à ajax.cavaliers.php pour gérer les résultats
            },
            success: function(data) {
                $('#modifier_nom_list_galop_id').show(); // Affiche la liste des résultats
                $('#modifier_nom_list_galop_id').html(data); // Remplit la liste avec les résultats
            },
        });
    } else {
        $('#modifier_nom_list_galop_id').hide(); // Cache la liste si le texte est trop court
    }
}

// Lors du clic sur un élément de la liste
function set_item_cavalier(item, id_galop) {
    // Mettre à jour le champ texte modifier_libgalop avec la valeur sélectionnée
    $('#modifier_libgalop').val(item);
    // Cacher la liste des suggestions après la sélection
    $('#modifier_nom_list_galop_id').hide();
    // Mettre à jour le champ caché modifier_idgalop avec l'ID du galop sélectionné
    $('#modifier_idgalop').val(id_galop);
}
function basculerFormulaire(id) {
    document.getElementById(id).style.display = "block";
}

function fermerFormulaire(id) {
    document.getElementById(id).style.display = "none";
}

// Activer/désactiver les boutons Modifier/Supprimer selon la sélection
document.querySelectorAll('input[name="selectedCavalier"]').forEach(radio => {
    radio.addEventListener('change', function () {
        document.getElementById('modifierButton').disabled = false;
        document.getElementById('supprimerButton').disabled = false;

        // Récupérer l'ID du cavalier sélectionné
        let selectedID = this.value;
        document.getElementById('modifier_idcava').value = selectedID;
        document.getElementById('supprimer_idcava').value = selectedID;
    });
});
