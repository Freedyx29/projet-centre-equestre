// Autocompletion for Race
function autocompletRace(id) {
    var min_length = 1; // Minimum characters to trigger autocompletion
    var keyword = $('#librace' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.race.php', // URL for the PHP file handling the AJAX request for race
            type: 'POST',
            data: { 
                keyword: keyword,
                index: id // Send the index to ajax.race.php to identify the current input field
            },
            success: function(data) {
                $('#race_list_id' + id).show(); // Show the suggestion list
                $('#race_list_id' + id).html(data); // Insert the suggestions from the PHP file
            }
        });
    } else {
        $('#race_list_id' + id).hide(); // Hide the list if the keyword is too short
    }
}

// When selecting an item from the list
function set_race_item(item, id, id_race) {
    // Update the librace field with the selected value
    $('#librace' + id).val(item);
    // Hide the suggestion list
    $('#race_list_id' + id).hide();
    // Update the hidden id_race field with the selected race's ID
    $('#id_race' + id).val(id_race);
}
