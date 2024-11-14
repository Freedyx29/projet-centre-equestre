// autocompletion
function autocompletPrendPen(id) {
    var min_length = 1;
    var keyword = $('#libpen' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.prend.idpen.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
                index: id // Envoie l'index à ajax_produit.php
            },
            success: function(data) {
                $('#nom_list_prend_pen_id' + id).show();
                $('#nom_list_prend_pen_id' + id).html(data);
            },
        });
    } else {
        $('#nom_list_prend_pen_id' + id).hide();
    }
}

function autocompletPrendPenajout() {
    var min_length = 1;
    var keyword = $('#libpen').val();

    if (keyword && keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.prend.idpenajout.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
            },
            success: function(data) {
                $('#nom_list_prend_pen_id').show();
                $('#nom_list_prend_pen_id').html(data);
            },
        });
    } else {
        $('#nom_list_prend_pen_id').hide();
    }
}

// Lors du choix dans la liste
function set_item_pen(item, id, id_pen) {
    // Mettre à jour le champ nomcom avec la valeur sélectionnée
    $('#libpen' + id).val(item);
    // Cacher la liste de suggestions
    $('#nom_list_prend_pen_id' + id).hide();
    // Mettre à jour le champ caché id_cat avec l'ID de la catégorie sélectionnée
    $('#id_pen' + id).val(id_pen);
}

function set_item_pen_ajout(item, id_pen) {
    $('#libpen').val(item);
    $('#nom_list_prend_pen_id').hide();
    $('#id_pen').val(id_pen);
}