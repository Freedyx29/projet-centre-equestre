<?php

include_once '../class/class.cavaliers.php';

$ocavaliers = new Cavaliers("","", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
$reqcavaliers = $ocavaliers->CavaliersALL();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Cavaliers</title>
    <link rel="stylesheet" href="../css/style.css">
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/script_cavaliers.js"></script>

</head>
<body>
<div class="container">
    <h2>CRUD Cavaliers</h2>

    <?php
    $i = 0;
    foreach($reqcavaliers as $unereqcavaliers) {
        if ($reqcavaliers [$i]['supprime'] == '0') {
            $unereqcavaliers = new Cavaliers($reqcavaliers[$i]["idcava"],$reqcavaliers[$i]["nomcava"],$reqcavaliers[$i]["prenomcava"],$reqcavaliers[$i]["datenacava"],$reqcavaliers[$i]["numlic"],$reqcavaliers[$i]["photo"],
                                               $reqcavaliers[$i]["nomresp"],$reqcavaliers[$i]["prenomresp"],$reqcavaliers[$i]["rueresp"],$reqcavaliers[$i]["vilresp"],$reqcavaliers[$i]["cpresp"],$reqcavaliers[$i]["telresp"],
                                               $reqcavaliers[$i]["emailresp"],$reqcavaliers[$i]["password"],$reqcavaliers[$i]["assurance"],$reqcavaliers[$i]["idgalop"]);
    ?>
        <form name="modifier" action="../traitement/traitement.cavaliers.php" method="POST" class="entry">
            <div class="form-header">
            <span>ID Cavaliers : <?php echo $unereqcavaliers->getidcava(); ?></span>

                <div class="form-buttons">
                    <input type="hidden" name="idcava" value="<?php echo $unereqcavaliers->getidcava(); ?>">
                    <button class="btn-primary" type="submit" name="modifier">Modifier</button>
                    <button class="btn-danger" type="submit" name="supprimer">Supprimer</button>
                </div>

            </div>

                <div class="form-group">
                    <label for="nomcava-<?php echo $i; ?>">Nom cavaliers :</label>
                    <input type="text" id="nomcava-<?php echo $i; ?>" name="nomcava" value="<?php echo $unereqcavaliers->getnomcava(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="prenomcava-<?php echo $i; ?>">Prénom cavaliers :</label>
                    <input type="text" id="prenomcava-<?php echo $i; ?>" name="prenomcava" value="<?php echo $unereqcavaliers->getprenomcava(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="datenacava-<?php echo $i; ?>">Date de naissance cavaliers :</label>
                    <input type="text" id="datenacava-<?php echo $i; ?>" name="datenacava" value="<?php echo $unereqcavaliers->getdatenacava(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="numlic-<?php echo $i; ?>">Numéro licence :</label>
                    <input type="text" id="numlic-<?php echo $i; ?>" name="numlic" value="<?php echo $unereqcavaliers->getnumlic(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="photo-<?php echo $i; ?>">Photo :</label>
                    <input type="text" id="photo-<?php echo $i; ?>" name="photo" value="<?php echo $unereqcavaliers->getphoto(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="nomresp-<?php echo $i; ?>">Nom responsable :</label>
                    <input type="text" id="nomresp-<?php echo $i; ?>" name="nomresp" value="<?php echo $unereqcavaliers->getnomresp(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="prenomresp-<?php echo $i; ?>">Prénom responsable :</label>
                    <input type="text" id="prenomresp-<?php echo $i; ?>" name="prenomresp" value="<?php echo $unereqcavaliers->getprenomresp(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="rueresp-<?php echo $i; ?>">Rue responsable :</label>
                    <input type="text" id="rueresp-<?php echo $i; ?>" name="rueresp" value="<?php echo $unereqcavaliers->getrueresp(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="vilresp-<?php echo $i; ?>">Ville responsable :</label>
                    <input type="text" id="vilresp-<?php echo $i; ?>" name="vilresp" value="<?php echo $unereqcavaliers->getvilresp(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="cpresp-<?php echo $i; ?>">Code postal responsable :</label>
                    <input type="text" id="cpresp-<?php echo $i; ?>" name="cpresp" value="<?php echo $unereqcavaliers->getcpresp(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="telresp-<?php echo $i; ?>">Téléphone responsable :</label>
                    <input type="text" id="telresp-<?php echo $i; ?>" name="telresp" value="<?php echo $unereqcavaliers->gettelresp(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="emailresp-<?php echo $i; ?>">Email responsable :</label>
                    <input type="text" id="emailresp-<?php echo $i; ?>" name="emailresp" value="<?php echo $unereqcavaliers->getemailresp(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="password-<?php echo $i; ?>">password :</label>
                    <input type="text" id="password-<?php echo $i; ?>" name="password" value="<?php echo $unereqcavaliers->getpassword(); ?>"required>
                </div>

                <div class="form-group">
                    <label for="assurance-<?php echo $i; ?>">Assurance :</label>
                    <input type="text" id="assurance-<?php echo $i; ?>" name="assurance" value="<?php echo $unereqcavaliers->getassurance(); ?>"required>
                </div>


                <div class="form-group">
                    <label for="libgalop<?php echo $i; ?>">Libellé galop :</label>
                    <input id="libgalop<?php echo $i; ?>" name="libgalop" type="text" value="<?php echo $ocavaliers->CavaliersGalop($unereqcavaliers->getidgalop()); ?>" onkeyup="autocompletGalop(<?php echo $i; ?>)"required>
                    <ul id="nom_list_galop_id<?php echo $i; ?>"></ul>
                </div>

                <input type="hidden" id="id_galop<?php echo $i; ?>" name="idgalop" value="<?php echo $unereqcavaliers->getidgalop(); ?>">

        </form>
    
    <?php
        }
        $i++;
    }
    ?>

    <div class="center-button">
        <button class="btn-primary" onclick="toggleForm()">Ajouter un cavaliers</button>
    </div>

    <a id="formAnchor"></a>

    <div class="form-popup" id="ajoutForm">
        <form action="../traitement/traitement.cavaliers.php" method="POST" class="form-container">
            <h3>Ajouter une modele</h3>

            <div class="form-group">
                <label for="nomcava"><b>Nom cavaliers :</b></label>
                <input type="text" id="nomcava" name="nomcava" placeholder="Entrer le nom du cavaliers" required>
            </div>

            <div class="form-group">
                <label for="prenomcava"><b>Prénom cavaliers:</b></label>
                <input type="text" id="prenomcava" name="prenomcava" placeholder="Entrer le prénom cavaliers" required>
            </div>

            <div class="form-group">
                <label for="datenacava"><b>Date naissance cavaliers :</b></label>
                <input type="text" id="datenacava" name="datenacava" placeholder="Entrer la date de naissance du cavaliers" required>
            </div>

            <div class="form-group">
                <label for="numlic"><b>Numéro licence :</b></label>
                <input type="text" id="numlic" name="numlic" placeholder="Entrer le numéro de licence" required>
            </div>

            <div class="form-group">
                <label for="photo"><b>Photo :</b></label>
                <input type="text" id="photo" name="photo" placeholder="Entrer le lien de la photo" required>
            </div>

            <div class="form-group">
                <label for="nomresp"><b>Nom responsable :</b></label>
                <input type="text" id="nomresp" name="nomresp" placeholder="Entrer le nom du responsable" required>
            </div>

            <div class="form-group">
                <label for="prenomresp"><b>Prénom du responsable :</b></label>
                <input type="text" id="prenomresp" name="prenomresp" placeholder="Entrer le prénom du responsable" required>
            </div>

            <div class="form-group">
                <label for="rueresp"><b>Rue responsable :</b></label>
                <input type="text" id="rueresp" name="rueresp" placeholder="Entrer la rue du responsablee" required>
            </div>

            <div class="form-group">
                <label for="vilresp"><b>Ville du responsable :</b></label>
                <input type="text" id="vilresp" name="vilresp" placeholder="Entrer la ville du responsable" required>
            </div>

            <div class="form-group">
                <label for="cpresp"><b>Code postal responsable :</b></label>
                <input type="text" id="cpresp" name="cpresp" placeholder="Entrer le code postal du responsable" required>
            </div>

            <div class="form-group">
                <label for="telresp"><b>Téléphone responsable :</b></label>
                <input type="text" id="telresp" name="telresp" placeholder="Entrer le téléphone du responsable" required>
            </div>

            <div class="form-group">
                <label for="emailresp"><b>Email du responsable :</b></label>
                <input type="text" id="emailresp" name="emailresp" placeholder="Entrer l'email du responsable" required>
            </div>

            <div class="form-group">
                <label for="password"><b>Password :</b></label>
                <input type="text" id="password" name="password" placeholder="Entrer le password" required>
            </div>

            <div class="form-group">
                <label for="assurance"><b>Assurance :</b></label>
                <input type="text" id="assurance" name="assurance" placeholder="Entrer l'assurance" required>
            </div>

            <div class="form-group">
                <label for="libgalop"><b>Libellé galop :</b></label>
                <input id="libgalop" name="libgalop" type="text" placeholder="Entrer le libellé galop"  onkeyup="autocompletGalopajout()" required>
                <ul id="nom_list_galop_id"</ul>
            </div>

            <input type="hidden" id="id_galop" name="idgalop" value="<?php echo $unereqcavaliers->getidgalop(); ?>">


            <button type="submit" name="ajouter" class="btn-primary">Ajouter</button>
        </form>
    </div>
</div>

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
</body>
</html>
