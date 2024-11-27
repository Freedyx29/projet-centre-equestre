<?php
include '../include/bdd.inc.php';

if(isset($_POST['keyword'])) {
	$con = connexionPDO();
$keyword = '%'.$_POST['keyword'].'%';

$sql = "SELECT * FROM pension WHERE libpen LIKE (:var) ORDER BY idpen ASC LIMIT 0, 100";
$req = $con->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();

$list = $req->fetchAll();

foreach ($list as $res) {
    $Listepension = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libpen']);
    // Correction: Utilisation de idpen au lieu de libpen comme ID
    echo '<li onclick="set_item_pen(\''.str_replace("'", "\'", $res['libpen']).'\', '.$_POST['index'].', '.$res['idpen'].')">'.$Listepension.'</li>';
    }
}

?>
