        $(document).ready(function() {
            $('#courseTable').DataTable({
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

            $(document).on('change', '.select-course', function() {
                if ($(this).is(':checked')) {
                    $('#edit_idcours').val($(this).data('idcours'));
                    $('#edit_libcours').val($(this).data('libcours'));
                    $('#edit_hdebut').val($(this).data('hdebut'));
                    $('#edit_hfin').val($(this).data('hfin'));
                    $('#delete_idcours').val($(this).data('idcours'));
                    $('#editButton').prop('disabled', false);
                    $('#deleteButton').prop('disabled', false);
                } else {
                    $('#editButton').prop('disabled', true);
                    $('#deleteButton').prop('disabled', true);
                }
            });
        });

        function toggleForm(formId) {
            document.getElementById('addForm').style.display = 'none';
            document.getElementById('editForm').style.display = 'none';
            document.getElementById('deleteForm').style.display = 'none';
            document.getElementById(formId).style.display = 'block';
        }

        function closeForm(formId) {
            document.getElementById(formId).style.display = 'none';
        }