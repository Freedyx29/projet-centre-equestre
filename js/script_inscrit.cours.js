// autocompletion
function autocompletInscritCours(id) {
    var min_length = 1;
    var keyword = $('#libcours' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.inscrit.idcours.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
                index: id // Envoie l'index à ajax_produit.php
            },
            success: function(data) {
                $('#nom_list_inscrit_cours_id' + id).show();
                $('#nom_list_inscrit_cours_id' + id).html(data);
            },
        });
    } else {
        $('#nom_list_inscrit_cours_id' + id).hide();
    }
}

function autocompletInscritCoursajout() {
    var min_length = 1;
    var keyword = $('#libcours').val();

    if (keyword && keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.inscrit.idcoursajout.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
            },
            success: function(data) {
                $('#nom_list_inscrit_cours_id').show();
                $('#nom_list_inscrit_cours_id').html(data);
            },
        });
    } else {
        $('#nom_list_inscrit_cours_id').hide();
    }
}


// Lors du choix dans la liste
function set_item_cours(item, id, id_cours) {
    // Mettre à jour le champ nomcom avec la valeur sélectionnée
    $('#libcours' + id).val(item);
    // Cacher la liste de suggestions
    $('#nom_list_inscrit_cours_id' + id).hide();
    // Mettre à jour le champ caché id_cat avec l'ID de la catégorie sélectionnée
    $('#id_cours' + id).val(id_cours);
}

function set_item_cours_ajout(item, id_cours) {
    $('#libcours').val(item);
    $('#nom_list_inscrit_cours_id').hide();
    $('#id_cours').val(id_cours);
}