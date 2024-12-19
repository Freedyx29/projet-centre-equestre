// Autocomplétion pour le champ "Cheval" dans le formulaire de modification
function autocompletPension(id) {
    var min_length = 1;
    var keyword = $('#nomche' + id).val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.pension.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: id // Envoie l'index à ajax.pension.php
            },
            success: function(data) {
                $('#nom_list_pension_id' + id).show();
                $('#nom_list_pension_id' + id).html(data);
            },
        });
    } else {
        $('#nom_list_pension_id' + id).hide();
    }
}

// Autocomplétion pour le champ "Cheval" dans le formulaire d'ajout
function autocompletPensionajout() {
    var min_length = 1;
    var keyword = $('#nomche').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajax/ajax.pensionajout.php',
            type: 'POST',
            data: {
                keyword: keyword,
            },
            success: function(data) {
                $('#nom_list_pension_id').show();
                $('#nom_list_pension_id').html(data);
            },
        });
    } else {
        $('#nom_list_pension_id').hide();
    }
}

// Autocomplétion pour le champ "Nom Cavalier" dans le formulaire d'ajout
function autocompletCavalierajout1() {
   
    var keyword = $('#nomcava1').val();
    
    if (keyword.length == 0) {
        $('#nom_list_cavalier_id1').slideUp();
    } else {
        $.post('../ajax/ajax.pension.idcavaajout.php', {keyword: keyword}, function(data) {
            $('#nom_list_cavalier_id1').html(data);
            $('#nom_list_cavalier_id1').slideDown();
        });
    }
}
function autocompletCavalierajout2() {
   
    var keyword = $('#nomcava2').val();
    
    if (keyword.length == 0) {
        $('#nom_list_cavalier_id2').slideUp();
    } else {
        $.post('../ajax/ajax.pension.idcavaajoutt.php', {keyword: keyword}, function(data) {
            $('#nom_list_cavalier_id2').html(data);
            $('#nom_list_cavalier_id2').slideDown();
        });
    }
}
// Autocomplétion pour le champ "Nom Cavalier" dans le formulaire de modification
// Autocomplétion pour le champ "Nom Cavalier" dans le formulaire de modification
function autocompletCavaliermodif1(id) {
    var keyword = $('#nomcava3').val();

    if (keyword.length == 0) {
        $('#nom_list_cavalier_id3').slideUp();
    } else {
        $.post('../ajax/ajax.pension.idcavamodif.php', {keyword: keyword}, function(data) {
            $('#nom_list_cavalier_id3').html(data);
            $('#nom_list_cavalier_id3').slideDown();
        });
    }
}

function autocompletCavaliermodif2(id) {
    var keyword = $('#nomcava4').val();

    if (keyword.length == 0) {
        $('#nom_list_cavalier_id4').slideUp();
    } else {
        $.post('../ajax/ajax.pension.idcavamodift.php', {keyword: keyword}, function(data) {
            $('#nom_list_cavalier_id4').html(data);
            $('#nom_list_cavalier_id4').slideDown();
        });
    }
}


// Fonction pour définir l'élément sélectionné dans le champ "Nom Cavalier" dans le formulaire d'ajout
function set_item_cava_ajout1(item, id) {
    $('#nomcava1').val(item);
    $('#idcava1').val(id);
    $('#nom_list_cavalier_id1').slideUp();
}
function set_item_cava_ajout2(item, id) {
    $('#nomcava2').val(item);
    $('#idcava2').val(id);
    $('#nom_list_cavalier_id2').slideUp();
}
// Fonction pour définir l'élément sélectionné dans le champ "Nom Cavalier" dans le formulaire de modification
function set_item_cava_modif3(item, id) {
    $('#nomcava3').val(item);
    $('#idcava3').val(id);
    $('#nom_list_cavalier_id3').slideUp();
}
function set_item_cava_modif4(item, id) {
    $('#nomcava4').val(item);
    $('#idcava4').val(id);
    $('#nom_list_cavalier_id4').slideUp();
}
// Fonction pour définir l'élément sélectionné dans le champ "Cheval" dans le formulaire de modification
function set_item_pension(item, id, num_sire) {
    $('#nomche' + id).val(item);
    $('#nom_list_pension_id' + id).hide();
    $('#num_sire' + id).val(num_sire);
}

// Fonction pour définir l'élément sélectionné dans le champ "Cheval" dans le formulaire d'ajout
function set_item_pension_ajout(item, index ,num_sire) {
   
    $('#nomche').val(item);
    $('#nom_list_pension_id').hide();
    $('#num_sire').val(num_sire);
}

