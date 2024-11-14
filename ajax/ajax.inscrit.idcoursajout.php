<?php
include '../include/bdd.inc.php';

if(isset($_POST['keyword'])) {
	$con = connexionPDO();
$keyword = '%'.$_POST['keyword'].'%';

$sql = "SELECT * FROM cours WHERE libcours LIKE (:var) ORDER BY idcours ASC LIMIT 0, 100";
$req = $con->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();

$list = $req->fetchAll();

foreach ($list as $res) {
    $Listecoursajout = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libcours']);
    // Utilise l'index `id` pour l'élément HTML, qui est passé depuis la fonction autocomplet() dans le JavaScript
    echo '<li onclick="set_item_cours_ajout(\''.str_replace("'", "\'", $res['libcours']).'\',  '.$res['idcours'].')">'.$Listecoursajout.'</li>';
    }
}
?>