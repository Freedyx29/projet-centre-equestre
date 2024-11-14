<script>
    function toggleForm() {
        var form = document.getElementById("ajoutForm");
        form.classList.toggle("show");

        if (form.classList.contains("show")) {
            document.getElementById("formAnchor").scrollIntoView({ behavior: 'smooth' });
        }
    }

    function showAlert(message) {
        alert(message);
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success') === '1') {
        showAlert("update des données réussie !");
    } else if (urlParams.get('success') === '0') {
        showAlert("Erreur lors de la suppression.");
    }
</script>

<?php

include_once 'class.prend.php';

$oprend = new Prend();
$reqprend = $oprend->PrendAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Prend</title>
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/script_prend.cava.js"></script>
    <script type="text/javascript" src="../js/script_prend.pen.js"></script>
</head>
<body>
    <div class="container">
        <h2>CRUD Prend</h2>

        <?php

        $i = 0;
        foreach($reqprend as $unereqprend) {
            if ($reqprend [$i]['supprime'] == '0') {
                $unereqprend = new Prend($reqprend[$i]["refidcava"], $reqprend [$i]["refidpen"]);

        ?>
            <div class="engage-item">
                <form name="modifier" action="traitement.prend.php" method="POST" class="entry">
                    <div class="form-header">
                        <span>ID Cavalier : <?php echo $unereqprend->getrefidcava(); ?> | ID competition : <?php echo $unereqprend->getrefidpen(); ?></span>
                        <div class="form-buttons">
                            <input type="hidden" name="refidcava" value="<?php echo $unereqprend->getrefidcava(); ?>">
                            <input type="hidden" name="refidpen" value="<?php echo $unereqprend->getrefidpen(); ?>">
                            <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                            <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="nomcava<?php echo $i ?>">Nom du cavaliers</label>
                        <input id="nomcava<?php echo $i ?>" name="nomcava" type="text" value="<?php echo $oprend->PrendCava($unereqprend->getrefidcava());  ?>" onkeyup="autocompletPrendCava(<?php echo $i ?>)"required>
                        <ul id="nom_list_prend_cava_id<?php echo $i; ?>"></ul>
                    </div>

                    <input type="hidden" id="id_cava<?php echo $i; ?>" name="idcava" value="<?php echo $unereqprend->getrefidcava(); ?>">
                    <input type="hidden" id="id_cava_first" name="id_cava_first" value="<?php echo $reqprend[$i]["refidcava"]; ?>">


                    <div class="form-group">
                        <label for="libpen<?php echo $i ?>">Libellé de la pension</label>
                        <input id="libpen<?php echo $i ?>" name="libpen" type="text" value="<?php echo $oprend->PrendPen($unereqprend->getrefidpen());  ?>" onkeyup="autocompletPrendPen(<?php echo $i ?>)"required>
                        <ul id="nom_list_prend_pen_id<?php echo $i; ?>"></ul>
                    </div>

                    <input type="hidden" id="id_pen<?php echo $i; ?>" name="idpen" value="<?php echo $unereqprend->getrefidpen(); ?>">
                    <input type="hidden" id="id_pen_first" name="id_pen_first" value="<?php echo $reqprend[$i]["refidpen"]; ?>">

                </form>
            </div>

        <?php
        }
        $i++;
    }
    ?>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm()">Ajouter prend</button>
    </div>

    <a id="formAnchor"></a>

    <div class="form-popup" id="ajoutForm">
    <form action="traitement.prend.php" method="POST" class="form-container">
        <h3>Ajouter prend</h3>

        <div class="form-group">
            <label for="nomcava"><b>Nom du cavaliers :</b></label>
            <input id="nomcava" name="nomcava" type="text" placeholder="Entrer le nom du cavalier" onkeyup="autocompletPrendCavaajout()" required>
            <ul id="nom_list_prend_cava_id"></ul>
        </div>

        <input type="hidden" id="id_cava" name="idcava">

        <div class="form-group">
            <label for="libpen"><b>Libellé de la pension :</b></label>
            <input id="libpen" name="libpen" type="text" placeholder="Entrer la pension" onkeyup="autocompletPrendPenajout(<?php echo $i; ?>)" required>
            <ul id="nom_list_prend_pen_id"</ul>
        </div>

        <input type="hidden" id="id_pen" name="idpen">

        <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
    </form>
    </div>
    </div>
    
</body>
</html>