<?php
include '../include/bdd.inc.php';

if (isset($_POST['keyword'])) {
    $con = connexionPDO();
    $keyword = '%'.$_POST['keyword'].'%';

    $sql = "SELECT * FROM galop WHERE libgalop LIKE (:var) ORDER BY idgalop ASC LIMIT 0, 100";
    $req = $con->prepare($sql);
    $req->bindParam(':var', $keyword, PDO::PARAM_STR);
    $req->execute();

    $list = $req->fetchAll();

    foreach ($list as $res) {
        $Listegalop = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libgalop']);
        echo '<li onclick="set_item_cavalier(\''.str_replace("'", "\'", $res['libgalop']).'\', '.$res['idgalop'].')">'.$Listegalop.'</li>';
    }
}
?>
