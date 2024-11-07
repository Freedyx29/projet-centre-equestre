// autocompletion
function autocompletRace(id) {
    var min_length = 1;
    var keyword = $('#' + id + 'librace').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.cavalerie.race.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: id // Envoie l'index à ajax_produit.php
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

function autocompletRobe(id) {
    var min_length = 1;
    var keyword = $('#' + id + 'librobe').val();

    if (keyword.length >= min_length) {
        $.ajax({
            url: 'ajax.cavalerie.robe.php',
            type: 'POST',
            data: {
                keyword: keyword,
                index: id // Envoie l'index à ajax_produit.php
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
function set_item(item, id, id_fk, type) {
    if (type === 'race') {
        // Mettre à jour le champ librace avec la valeur sélectionnée
        $('#' + id + 'librace').val(item);
        // Cacher la liste de suggestions
        $('#' + id + 'nom_list_race_id').hide();
        // Mettre à jour le champ caché id_race avec l'ID de la race sélectionnée
        $('#' + id + 'id_race').val(id_fk);
    } else if (type === 'robe') {
        // Mettre à jour le champ librobe avec la valeur sélectionnée
        $('#' + id + 'librobe').val(item);
        // Cacher la liste de suggestions
        $('#' + id + 'nom_list_robe_id').hide();
        // Mettre à jour le champ caché id_robe avec l'ID de la robe sélectionnée
        $('#' + id + 'id_robe').val(id_fk);
    }
}



    $(document).ready(function() {
        $('#cavalerieTable').DataTable({
            "language": {
                "search": "Rechercher",
                "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                "lengthMenu": "Afficher _MENU_ entrées",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            }
        });

        $(document).on('change', '.select-cavalerie', function() {
            var numsire = $(this).data('numsire');
            var nomche = $(this).data('nomche');
            var datenache = $(this).data('datenache');
            var garrot = $(this).data('garrot');
            var race = $(this).data('race');
            var robe = $(this).data('robe');

            if ($(this).is(':checked')) {
                $('#modifier_numsire').val(numsire);
                $('#modifier_nomche').val(nomche);
                $('#modifier_datenache').val(datenache);
                $('#modifier_garrot').val(garrot);
                $('#modifier_librace').val(race);
                $('#modifier_librobe').val(robe);
                $('#supprimer_numsire').val(numsire);
                $('#modifierButton').prop('disabled', false);
                $('#supprimerButton').prop('disabled', false);
            } else {
                $('#modifierButton').prop('disabled', true);
                $('#supprimerButton').prop('disabled', true);
            }
        });
    });






