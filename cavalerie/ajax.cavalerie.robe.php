<?php
include '../include/bdd.inc.php';

$pdo = connexionPDO();
$searchTerm = $_GET['term'];

$query = $pdo->prepare("SELECT idrobe AS id, librobe AS label FROM robe WHERE librobe LIKE ? AND supprime = 0");
$query->execute(["%$searchTerm%"]);
$results = $query->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
