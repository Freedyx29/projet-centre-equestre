<?php
include '../include/bdd.inc.php';

$eventId = $_GET['eventId'];

try {
    $pdo = connexionPDO();
    $query = "
        SELECT ca.idcava
        FROM participe p
        JOIN cavaliers ca ON p.refidcava = ca.idcava
        WHERE p.refidcoursseance = :eventId
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':eventId' => $eventId]);
    $participants = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($participants);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
}
?> 