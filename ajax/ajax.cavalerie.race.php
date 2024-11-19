<?php
include '../include/bdd.inc.php';

if(isset($_POST['keyword'])) {
    $con = connexionPDO();
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT * FROM race WHERE librace LIKE (:var) ORDER BY idrace ASC LIMIT 0, 100";
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    $list = $req->fetchAll();

    foreach ($list as $res) {
        $ListeRace = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['librace']);
        echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['librace']).'\', \''.$_POST['index'].'\', '.$res['idrace'].', \'race\')">'.$ListeRace.'</li>';
    }
}
?>
