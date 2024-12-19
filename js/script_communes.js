// Autocomplétion pour les villes et codes postaux
function autocompleteCommune(id, type) {
    var min_length = 1;
    var keyword = type === 'ville' ? $('#ville' + id).val() : $('#cp' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.communes.php',
            type: 'POST',
            data: {
                keyword: keyword,
                type: type,
                index: id
            },
            success: function(data) {
                $('#commune_list_' + type + '_' + id).show();
                $('#commune_list_' + type + '_' + id).html(data);
            }
        });
    } else {
        $('#commune_list_' + type + '_' + id).hide();
    }
}

// Pour le formulaire d'ajout
function autocompleteCommuneAjout(type) {
    var min_length = 1;
    var keyword = type === 'ville' ? $('#ville').val() : $('#cp').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.communes.php',
            type: 'POST',
            data: {
                keyword: keyword,
                type: type,
                index: ''
            },
            success: function(data) {
                $('#commune_list_' + type).show();
                $('#commune_list_' + type).html(data);
            }
        });
    } else {
        $('#commune_list_' + type).hide();
    }
}

// Fonction pour définir les valeurs sélectionnées
function set_item_commune(ville, cp, id) {
    if(id === '' || id === undefined) {  // Ajout de la vérification pour undefined
        // Pour le formulaire d'ajout
        $('#ville').val(ville);
        $('#cp').val(cp);
        $('#commune_list_ville').hide();
        $('#commune_list_cp').hide();
    } else {
        // Pour le formulaire de modification
        $('#ville' + id).val(ville);
        $('#cp' + id).val(cp);
        $('#commune_list_ville_' + id).hide();
        $('#commune_list_cp_' + id).hide();
    }
}

