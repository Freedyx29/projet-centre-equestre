// Autocompletion pour la robe
function autocompletRobe(id) {
    var min_length = 1;
    var keyword = $('#' + id + 'librobe').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.cavalerie.robe.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: id
            },
            success: function(data) {
                $('#' + id + 'nom_list_robe_id').show();
                $('#' + id + 'nom_list_robe_id').html(data);
            },
        });
    } else {
        $('#' + id + 'nom_list_robe_id').hide();
    }
}

// Lors du choix dans la liste
function set_item(item, id, id_robe, type) {
    if (type === 'robe') {
        $('#' + id + 'librobe').val(item);
        $('#' + id + 'nom_list_robe_id').hide();
        $('#' + id + 'id_robe').val(id_robe);
    }
}
