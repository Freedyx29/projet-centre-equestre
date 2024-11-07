<?php
include '../include/bdd.inc.php';

if(isset($_POST['keyword'])) {
	$con = connexionPDO();
$keyword = '%'.$_POST['keyword'].'%';

$sql = "SELECT * FROM galop WHERE libgalop LIKE (:var) ORDER BY idgalop ASC LIMIT 0, 100";
$req = $con->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();

$list = $req->fetchAll();

foreach ($list as $res) {
    $Listegalop = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libgalop']);
    // Utilise l'index `id` pour l'élément HTML, qui est passé depuis la fonction autocomplet() dans le JavaScript
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['libgalop']).'\', '.$_POST['index'].', '.$res['idgalop'].')">'.$Listegalop.'</li>';
    }
}
?>