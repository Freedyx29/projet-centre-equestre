// autocompletion
function autocompletGalop(id) {
    var min_length = 1;
    var keyword = $('#libgalop' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.cavaliers.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: id // Envoie l'index à ajax_produit.php
            },
            success: function(data) {
                $('#nom_list_galop_id' + id).show();
                $('#nom_list_galop_id' + id).html(data);
            },
        });
    } else {
        $('#nom_list_galop_id' + id).hide();
    }
}

function autocompletGalopajout() {
    var min_length = 1;
    var keyword = $('#libgalop').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.cavaliersajout.php',
            type: 'POST',
            data: {
                keyword: keyword,
            },
            success: function(data) {
                $('#nom_list_galop_id').show();
                $('#nom_list_galop_id').html(data);
            },
        });
    } else {
        $('#nom_list_galop_id').hide();
    }
}
// Lors du choix dans la liste
function set_item_galop(item, id, id_galop) {
    // Mettre à jour le champ libgalop avec la valeur sélectionnée
    $('#libgalop' + id).val(item);
    // Cacher la liste de suggestions
    $('#nom_list_galop_id' + id).hide();
    // Mettre à jour le champ caché num_sire avec l'ID de la catégorie sélectionnée
    $('#id_galop' + id).val(id_galop);
}

function set_item_galop_ajout(item, id_galop) {
    $('#libgalop').val(item);
    $('#nom_list_galop_id').hide();
    $('#id_galop').val(id_galop);
}
