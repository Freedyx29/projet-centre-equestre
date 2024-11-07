<?php
include '../include/bdd.inc.php'; // Connexion à la base de données

$pdo = connexionPDO(); // Connexion à la base de données

$term = $_GET['term'] ?? ''; // Termes de recherche
$results = [];

if ($term) {
    // Requête pour récupérer les robes correspondant au terme
    $stmt = $pdo->prepare("SELECT idrobe, librobe FROM robe WHERE librobe LIKE ? LIMIT 10");
    $stmt->execute(['%' . $term . '%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Formater les résultats pour jQuery UI Autocomplete
$response = [];
foreach ($results as $row) {
    $response[] = [
        'id' => $row['idrobe'], // ID de la robe
        'label' => $row['librobe'], // Nom de la robe
        'value' => $row['librobe'], // Valeur à afficher
    ];
}

echo json_encode($response); // Retourner les résultats en JSON
?>