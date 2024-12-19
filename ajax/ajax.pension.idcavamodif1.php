<?php
include '../include/bdd.inc.php';

if(isset($_POST['keyword'])) {
    $con = connexionPDO();
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT * FROM cavaliers WHERE nomcava LIKE (:var) ORDER BY idcava ASC LIMIT 0, 100";
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    $list = $req->fetchAll();

    foreach ($list as $res) {
        $Listecavaliersajout = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['nomcava']);
        echo '<li onclick="set_item_cava_modif3(\''.str_replace("'", "\'", $res['nomcava']).'\',  '.$res['idcava'].')">'.$Listecavaliersajout.'</li>';
    }
}
?>
