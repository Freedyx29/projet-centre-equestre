// autocompletion
function autocompletRobe(id) {
    var min_length = 1;
    var keyword = $('#librobe' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.cavalerie.robe.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: id // Envoie l'index à ajax_produit.php
            },
            success: function(data) {
                $('#nom_list_robe_id' + id).show();
                    $('#nom_list_robe_id' + id).html(data);
            },
        });
    } else {
        $('#nom_list_robe_id' + id).hide();
    }
}

function autocompletRobeajout() {
    var min_length = 1;
    var keyword = $('#librobe').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.cavalerie.robeajout.php',
            type: 'POST',
            data: {
                keyword: keyword,
            },
            success: function(data) {
                $('#nom_list_robe_id').show();
                $('#nom_list_robe_id').html(data);
            },
        });
    } else {
        $('#nom_list_robe_id').hide();
    }
}

// Lors du choix dans la liste
function set_item_robe(item, id, id_robe) {
    // Mettre à jour le champ libgalop avec la valeur sélectionnée
    $('#librobe' + id).val(item);
    // Cacher la liste de suggestions
    $('#nom_list_robe_id' + id).hide();
    // Mettre à jour le champ caché num_sire avec l'ID de la catégorie sélectionnée
    $('#id_robe' + id).val(id_robe);
}

function set_item_robe_ajout(item, id_robe) {
    $('#librobe').val(item);
    $('#nom_list_robe_id').hide();
    $('#id_robe').val(id_robe);
}
