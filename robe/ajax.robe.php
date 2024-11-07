<?php
include '../include/bdd.inc.php';

if(isset($_POST['keyword'])) {
    $con = connexionPDO();
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT * FROM fk WHERE libfk LIKE :var ORDER BY idfk ASC LIMIT 0, 100";
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    $list = $req->fetchAll();

    foreach ($list as $res) {
        // Met en gras le mot-clé recherché dans le résultat
        $Listefk = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libfk']);
        // Utilise l'index `id` passé par la fonction autocomplet() dans le JavaScript
        echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['libfk']).'\', '.$_POST['index'].', '.$res['idfk'].')">'.$Listefk.'</li>';
    }
}
?>
