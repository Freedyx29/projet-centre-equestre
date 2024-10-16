        $(function() {
            $("#idrace").autocomplete({
                source: "ajax.cavalerie.race.php",
                minLength: 2,
                select: function(event, ui) {
                    $("input[name='idrace_id']").val(ui.item.id);
                }
            });

            $("#idrobe").autocomplete({
                source: "ajax.cavalerie.robe.php",
                minLength: 2,
                select: function(event, ui) {
                    $("input[name='idrobe_id']").val(ui.item.id);
                }
            });
        });