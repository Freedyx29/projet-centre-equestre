<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

include '../include/bdd.inc.php';

try {
    $pdo = connexionPDO();
} catch (PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
    exit;
}

$query = "
    SELECT
        c.idcoursseance,
        c.datecours,
        cb.libcours,
        TIME_FORMAT(cb.hdebut, '%H:%i') AS hdebut,
        TIME_FORMAT(cb.hfin, '%H:%i') AS hfin,
        GROUP_CONCAT(DISTINCT ca.nomcava SEPARATOR ', ') AS cavaliers
    FROM
        calendrier c
    JOIN
        cours cb ON c.idcoursbase = cb.idcours
    LEFT JOIN
        participe p ON c.idcoursseance = p.refidcoursseance
    LEFT JOIN
        cavaliers ca ON p.refidcava = ca.idcava
    WHERE
        c.supprime = 0 AND cb.supprime = 0
    GROUP BY
        c.idcoursseance, c.datecours, cb.libcours, cb.hdebut, cb.hfin
    ORDER BY
        c.datecours, cb.hdebut
";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Query failed: ' . $e->getMessage()]);
    exit;
}

$formattedEvents = [];
foreach ($events as $event) {
    $formattedEvents[] = [
        'id' => $event['idcoursseance'],
        'title' => $event['libcours'] . ' - ' . $event['cavaliers'],
        'start' => $event['datecours'] . 'T' . $event['hdebut'],
        'end' => $event['datecours'] . 'T' . $event['hfin'],
        'extendedProps' => [
            'hdebut' => $event['hdebut'],
            'hfin' => $event['hfin'],
            'cavaliers' => $event['cavaliers']
        ]
    ];
}

$jsonString = json_encode($formattedEvents);
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'JSON encoding error: ' . json_last_error_msg()]);
    exit;
}

echo $jsonString;
?>
