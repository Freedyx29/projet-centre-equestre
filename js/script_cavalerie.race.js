// autocompletion
function autocompletRace(id) {
    var min_length = 1;
    var keyword = $('#librace' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.cavalerie.race.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
                index: id
            },
            success: function(data) {
                $('#nom_list_race_id' + id).show();
                $('#nom_list_race_id' + id).html(data);
            },
        });
    } else {
        $('#nom_list_race_id' + id).hide();
    }
}

function autocompletRaceajout() {
    var min_length = 1;
    var keyword = $('#librace').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.cavalerie.raceajout.php', 
            type: 'POST',
            data: { 
                keyword: keyword,
            },
            success: function(data) {
                $('#nom_list_race_id').show();
                $('#nom_list_race_id').html(data);
            },
        });
    } else {
        $('#nom_list_race_id').hide();
    }
}


// Lors du choix dans la liste
function set_item(item, id, id_race) {
    // Mettre à jour le champ librace avec la valeur sélectionnée
    $('#librace' + id).val(item);
    // Cacher la liste de suggestions
    $('#nom_list_race_id' + id).hide();
    // Mettre à jour le champ caché id_race avec l'ID de la catégorie sélectionnée
    $('#id_race' + id).val(id_race);
}

function set_item_ajout(item, id_race) {
    $('#librace').val(item);
    $('#nom_list_race_id').hide();
    $('#id_race').val(id_race);
}