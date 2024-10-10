<?php
include '../include/bdd.inc.php'; // Connexion à la base de données

$pdo = connexionPDO(); // Connexion à la base de données

$term = $_GET['term'] ?? ''; // Termes de recherche
$results = [];

if ($term) {
    // Requête pour récupérer les races correspondant au terme
    $stmt = $pdo->prepare("SELECT idrace, librace FROM race WHERE librace LIKE ? LIMIT 10");
    $stmt->execute(['%' . $term . '%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Formater les résultats pour jQuery UI Autocomplete
$response = [];
foreach ($results as $row) {
    $response[] = [
        'id' => $row['idrace'], // ID de la race
        'label' => $row['librace'], // Nom de la race
        'value' => $row['librace'], // Valeur à afficher
    ];
}

echo json_encode($response); // Retourner les résultats en JSON
?>
