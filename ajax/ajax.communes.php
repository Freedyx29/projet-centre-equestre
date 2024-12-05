<?php
include '../include/bdd.inc.php';

if(isset($_POST['keyword'])) {
    $con = connexionPDO();
    $keyword = '%'.$_POST['keyword'].'%';
    $type = $_POST['type']; // Garder le type

    if ($type === 'ville') {
        $sql = "SELECT * FROM commune.v_commune_2023 WHERE ville LIKE (:var) ORDER BY ville ASC LIMIT 0, 100";
    } else {
        $sql = "SELECT * FROM commune.v_commune_2023 WHERE cp LIKE (:var) ORDER BY cp ASC LIMIT 0, 100";
    }
    
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    $list = $req->fetchAll();

    foreach ($list as $res) {
        $ListeCommune = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $type === 'ville' ? $res['ville'] : $res['cp']);
        // Utilise l'index `id` pour l'élément HTML, qui est passé depuis la fonction autocomplet() dans le JavaScript
        echo '<li onclick="set_item_commune(\''.str_replace("'", "\'", $res['ville']).'\', \''.$res['cp'].'\', '.$_POST['index'].')">'.$ListeCommune.'</li>';
    }
}
?>