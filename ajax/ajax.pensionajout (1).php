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
        $Listechevaux = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['nomche']);

        // Vérifiez si la clé 'index' existe dans le tableau $_POST
        $index = isset($_POST['index']) ? $_POST['index'] : 0;

        echo '<li onclick="set_item_pension_ajout(\''.str_replace("'", "\'", $res['nomche']).'\', '.$index.', '.$res['numsire'].')">'.$Listechevaux.'</li>';
    }
}
?>
