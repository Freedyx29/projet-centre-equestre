<?php
include '../include/bdd.inc.php';

$pdo = connexionPDO();
$searchTerm = $_GET['term'];

$query = $pdo->prepare("SELECT idrace AS id, librace AS label FROM race WHERE librace LIKE ? AND supprime = 0");
$query->execute(["%$searchTerm%"]);
$results = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
