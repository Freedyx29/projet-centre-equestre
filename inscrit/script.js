$(document).ready(function() {
    $('#inscritTable').DataTable({
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

    $(document).on('change', '.select-inscrit', function() {
        var idcours = $(this).data('idcours');
        var idcava = $(this).data('idcava');

        if ($(this).is(':checked')) {
            $('#modifier_idcours').val(idcours);
            $('#modifier_idcava').val(idcava);
            $('#supprimer_idcours').val(idcours);
            $('#supprimer_idcava').val(idcava);
            $('#modifierButton').prop('disabled', false);
            $('#supprimerButton').prop('disabled', false);
        } else {
            $('#modifierButton').prop('disabled', true);
            $('#supprimerButton').prop('disabled', true);
        }
    });
});

function toggleForm(formId) {
    var form = document.getElementById(formId);
    if (form.style.display === "none" || form.style.display === "") {
        form.style.display = "block";
        if (formId === 'editForm') {
            var selectedInscrit = document.querySelector('.select-inscrit:checked');
            if (selectedInscrit) {
                var idcours = selectedInscrit.getAttribute('data-idcours');
                var idcava = selectedInscrit.getAttribute('data-idcava');
                var libcours = selectedInscrit.getAttribute('data-libcours');
                var nomcava = selectedInscrit.getAttribute('data-nomcava');

                document.getElementById('modifier_idcours').value = idcours;
                document.getElementById('modifier_idcava').value = idcava;
                document.getElementById('modifier_libcours').value = libcours;
                document.getElementById('modifier_nomcava').value = nomcava;
            }
        }
    } else {
        form.style.display = "none";
    }
}



function closeForm(formId) {
    document.getElementById(formId).style.display = "none";
}

// Autocompletion functions
function autocompletCours(prefix) {
    $.ajax({
        url: 'autocomplete.php', // Your PHP file that returns course suggestions
        method: 'GET',
        data: { prefix: prefix },
        success: function(data) {
            $('#nom_list_cours_id').html(data);
        }
    });
}

function autocompletCava(prefix) {
    $.ajax({
        url: 'autocomplete.php', // Your PHP file that returns rider suggestions
        method: 'GET',
        data: { prefix: prefix },
        success: function(data) {
            $('#nom_list_cava_id').html(data);
        }
    });
}


// Lors du choix dans la liste
function set_item(item, id, id_fk, type) {
    if (type === 'cours') {
        // Mettre à jour le champ libcours avec la valeur sélectionnée
        $('#' + id + 'libcours').val(item);
        // Cacher la liste de suggestions
        $('#' + id + 'nom_list_cours_id').hide();
        // Mettre à jour le champ caché id_cours avec l'ID du cours sélectionné
        $('#' + id + 'id_cours').val(id_fk);
    } else if (type === 'cava') {
        // Mettre à jour le champ nomcava avec la valeur sélectionnée
        $('#' + id + 'nomcava').val(item);
        // Cacher la liste de suggestions
        $('#' + id + 'nom_list_cava_id').hide();
        // Mettre à jour le champ caché id_cava avec l'ID du cavalier sélectionné
        $('#' + id + 'id_cava').val(id_fk);
    }
}
