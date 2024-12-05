// autocompletion
function autocompletCoursCava(id) {
    var min_length = 1;
    var keyword = $('#nomcava' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.cours.idcava.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
                index: id // Envoie l'index à ajax_produit.php
            },
            success: function(data) {
                $('#nom_list_cours_cava_id' + id).show();
                $('#nom_list_cours_cava_id' + id).html(data);
            },
        });
    } else {
        $('#nom_list_cours_cava_id' + id).hide();
    }
}

function autocompletCoursCavaajout() {
    var min_length = 1;
    var keyword = $('#nomcava').val();

    if (keyword && keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.cours.idcavaajout.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
            },
            success: function(data) {
                $('#nom_list_cours_cava_id').show();
                $('#nom_list_cours_cava_id').html(data);
            },
        });
    } else {
        $('#nom_list_cours_cava_id').hide();
    }
}


// Lors du choix dans la liste
function set_item_cava(item, id, id_cava) {
    // Mettre à jour le champ nomcom avec la valeur sélectionnée
    $('#nomcava' + id).val(item);
    // Cacher la liste de suggestions
    $('#nom_list_cours_cava_id' + id).hide();
    // Mettre à jour le champ caché id_cat avec l'ID de la catégorie sélectionnée
    $('#id_cava' + id).val(id_cava);
}

function set_item_cava_ajout(item, id_cava) {
    $('#nomcava').val(item);
    $('#nom_list_cours_cava_id').hide();
    $('#id_cava').val(id_cava);
}