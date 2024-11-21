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

include_once '../class/class.inscrit.php';

$oinscrit = new Inscrit();
$reqinscrit = $oinscrit->InscritALL();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Inscrit</title>
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/script_inscrit.cours.js"></script>
    <script type="text/javascript" src="../js/script_inscrit.cava.js"></script>
</head>
<body>
    <div class="container">
        <h2>CRUD Inscrit</h2>

        <?php

        $i = 0;
        foreach($reqinscrit as $unereqinscrit) {
            if ($reqinscrit [$i]['supprime'] == '0') {
                $unereqinscrit = new Inscrit($reqinscrit[$i]["refidcours"], $reqinscrit [$i]["refidcava"]);

        ?>
            <div class="engage-item">
                <form name="modifier" action="../traitement/traitement.inscrit.php" method="POST" class="entry">
                    <div class="form-header">
                        <span>ID Cours : <?php echo $unereqinscrit->getrefidcours(); ?> | ID Cavaliers : <?php echo $unereqinscrit->getrefidcava(); ?></span>
                        <div class="form-buttons">
                            <input type="hidden" name="refidcours" value="<?php echo $unereqinscrit->getrefidcours(); ?>">
                            <input type="hidden" name="refidcava" value="<?php echo $unereqinscrit->getrefidcava(); ?>">
                            <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                            <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                    </div>
                    </div>

                    <div class="form-group">
                        <label for="libcours<?php echo $i ?>">Libellé du cours :</label>
                        <input id="libcours<?php echo $i ?>" name="libcours" type="text" value="<?php echo $oinscrit->InscritCours($unereqinscrit->getrefidcours());  ?>" onkeyup="autocompletInscritCours(<?php echo $i ?>)"required>
                        <ul id="nom_list_inscrit_cours_id<?php echo $i; ?>"></ul>
                    </div>

                    <input type="hidden" id="id_cours<?php echo $i; ?>" name="idcours" value="<?php echo $unereqinscrit->getrefidcours(); ?>">
                    <input type="hidden" id="id_cours_first" name="id_cours_first" value="<?php echo $reqinscrit[$i]["refidcours"]; ?>">
                    

                    <div class="form-group">
                        <label for="nomcava<?php echo $i ?>">Nom du cavaliers :</label>
                        <input id="nomcava<?php echo $i ?>" name="nomcava" type="text" value="<?php echo $oinscrit->InscritCava($unereqinscrit->getrefidcava());  ?>" onkeyup="autocompletInscritCava(<?php echo $i ?>)"required>
                        <ul id="nom_list_inscrit_cava_id<?php echo $i; ?>"></ul>
                    </div>

                    <input type="hidden" id="id_cava<?php echo $i; ?>" name="idcava" value="<?php echo $unereqinscrit->getrefidcava(); ?>">
                    <input type="hidden" id="id_cava_first" name="id_cava_first" value="<?php echo $reqinscrit[$i]["refidcava"]; ?>">

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
    <form action="../traitement/traitement.inscrit.php" method="POST" class="form-container">
        <h3>Ajouter prend</h3>

        <div class="form-group">
            <label for="libcours"><b>Libellé du cours :</b></label>
            <input id="libcours" name="libcours" type="text" placeholder="Entrer le cours" onkeyup="autocompletInscritCoursajout()" required>
            <ul id="nom_list_inscrit_cours_id"</ul>
        </div>

        <input type="hidden" id="id_cours" name="idcours">


        <div class="form-group">
            <label for="nomcava"><b>Nom du cavaliers :</b></label>
            <input id="nomcava" name="nomcava" type="text" placeholder="Entrer le nom du cavalier" onkeyup="autocompletInscritCavaajout()" required>
            <ul id="nom_list_inscrit_cava_id"></ul>
        </div>

        <input type="hidden" id="id_cava" name="idcava">

        <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
    </form>
    </div>
    </div>
    
</body>
</html>
