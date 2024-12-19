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
        cb.idcours,
        cb.libcours,
        TIME_FORMAT(cb.hdebut, '%H:%i') AS hdebut,
        TIME_FORMAT(cb.hfin, '%H:%i') AS hfin
    FROM
        calendrier c
    JOIN
        cours cb ON c.idcoursbase = cb.idcours
    WHERE
        c.supprime = 0 AND cb.supprime = 0
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
        'id' => $event['idcours'],
        'title' => $event['libcours'],
        'start' => $event['datecours'] . 'T' . $event['hdebut'],
        'end' => $event['datecours'] . 'T' . $event['hfin'],
        'extendedProps' => [
            'hdebut' => $event['hdebut'],
            'hfin' => $event['hfin']
        ]
    ];
}

echo json_encode($formattedEvents);
?> 