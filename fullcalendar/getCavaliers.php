<?php
include '../include/bdd.inc.php';

try {
    $pdo = connexionPDO();
    $courseId = $_GET['courseId'] ?? null;

    if (!$courseId) {
        throw new Exception('ID du cours non fourni');
    }

    $query = "SELECT DISTINCT c.idcava, c.nomcava 
              FROM cavaliers c 
              JOIN inscrit i ON c.idcava = i.refidcava 
              WHERE i.refidcours = :courseId 
              AND i.supprime = 0";

    $stmt = $pdo->prepare($query);
    $stmt->execute(['courseId' => $courseId]);
    $cavaliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($cavaliers);

} catch (Exception $e) {
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
?> 