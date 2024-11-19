// Autocompletion pour la race
function autocompletRace(id) {
    var min_length = 1;
    var keyword = $('#' + id + 'librace').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.cavalerie.race.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: id
            },
            success: function(data) {
                $('#' + id + 'nom_list_race_id').show();
                $('#' + id + 'nom_list_race_id').html(data);
            },
        });
    } else {
        $('#' + id + 'nom_list_race_id').hide();
    }
}

// Lors du choix dans la liste
function set_item(item, id, id_race, type) {
    if (type === 'race') {
        $('#' + id + 'librace').val(item);
        $('#' + id + 'nom_list_race_id').hide();
        $('#' + id + 'id_race').val(id_race);
    }
}
