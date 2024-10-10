        $(document).ready(function() {
            $("#idrace").autocomplete({
                source: "ajax.cavalerie.race.php",
                minLength: 2,
                select: function(event, ui) {
                    $("#idrace_hidden").val(ui.item.id);
                }
            });

            $("#idrobe").autocomplete({
                source: "ajax.cavalerie.robe.php",
                minLength: 2,
                select: function(event, ui) {
                    $("#idrobe_hidden").val(ui.item.id);
                }
            });
        });