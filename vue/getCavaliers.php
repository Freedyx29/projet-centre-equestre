<?php
include '../include/bdd.inc.php';

try {
    $pdo = connexionPDO();
    $courseId = $_GET['courseId'];
    
    // Récupérer l'ID du cours de base
    $query1 = "
        SELECT idcoursbase 
        FROM calendrier 
        WHERE idcoursseance = :idcoursseance
    ";
    $stmt1 = $pdo->prepare($query1);
    $stmt1->execute([':idcoursseance' => $courseId]);
    $coursBase = $stmt1->fetchColumn();
    
    // Récupérer les cavaliers inscrits
    $query2 = "
        SELECT DISTINCT c.idcava, c.nomcava
        FROM cavaliers c
        INNER JOIN inscrit i ON c.idcava = i.refidcava
        WHERE i.refidcours = :idcours 
        AND c.supprime = 0
        AND i.supprime = 0
    ";
    
    $stmt2 = $pdo->prepare($query2);
    $stmt2->execute([':idcours' => $coursBase]);
    $cavaliers = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    error_log("Cours base: " . $coursBase);
    error_log("Cavaliers trouvés: " . print_r($cavaliers, true));
    
    echo json_encode($cavaliers);
} catch (PDOException $e) {
    error_log("Erreur SQL: " . $e->getMessage());
    echo json_encode(['error' => $e->getMessage()]);
}
?> 