// autocompletion
function autocompletNomche(id) {
    var min_length = 1;
    var keyword = $('#nomche' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.pension.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
                index: id // Envoie l'index à ajax_produit.php
            },
            success: function(data) {
                $('#nom_list_nomche_id' + id).show();
                $('#nom_list_nomche_id' + id).html(data);
            },
        });
    } else {
        $('#nom_list_nomche_id' + id).hide();
    }
}

function autocompletNomcheajout() {
    var min_length = 1;
    var keyword = $('#nomche').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.pensionajout.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
                // Envoie l'index à ajax_produit.php
            },
            success: function(data) {
                $('#nom_list_nomche_id').show();
                $('#nom_list_nomche_id').html(data);
            },
        });
    } else {
        $('#nom_list_nomche_id').hide();
    }
}


// Lors du choix dans la liste
function set_item(item, id, num_sire) {
    // Mettre à jour le champ libgalop avec la valeur sélectionnée
    $('#nomche' + id).val(item);
    // Cacher la liste de suggestions
    $('#nom_list_nomche_id' + id).hide();
    // Mettre à jour le champ caché id_galop avec l'ID de la catégorie sélectionnée
    $('#num_sire' + id).val(num_sire);
}

function set_item_ajout(item, num_sire) {
    $('#nomche').val(item);
    $('#nom_list_nomche_id').hide();
    $('#num_sire').val(num_sire);
}