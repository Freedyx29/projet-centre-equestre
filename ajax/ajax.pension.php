<?php
include '../include/bdd.inc.php';

if(isset($_POST['keyword'])) {
    $con = connexionPDO();
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT * FROM cavalerie WHERE nomche LIKE (:var) ORDER BY numsire ASC LIMIT 0, 100";
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    $list = $req->fetchAll();

    foreach ($list as $res) {
        $Listepension = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['nomche']);
        // Utilise l'index `id` pour l'élément HTML, qui est passé depuis la fonction autocomplet() dans le JavaScript
        echo '<li onclick="set_item_pension(\''.str_replace("'", "\'", $res['nomche']).'\', '.$_POST['index'].', '.$res['numsire'].')">'.$Listepension.'</li>';
    }
}
?>
