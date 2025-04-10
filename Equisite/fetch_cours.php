<?php
require_once '../include/bdd.inc.php';

header('Content-Type: application/json');

$pdo = connexionPDO();

$itemsPerPage = 5; // Changé à 5
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $itemsPerPage;

$query = "SELECT * FROM cours WHERE supprime = 0";
$params = [];

if (!empty($_GET['galop'])) {
    $query .= " AND libcours LIKE :galop";
    $params[':galop'] = '%' . $_GET['galop'] . '%';
}
if (!empty($_GET['hour'])) {
    $query .= " AND hdebut LIKE :hour";
    $params[':hour'] = $_GET['hour'] . '%';
}
if (!empty($_GET['day'])) {
    $query .= " AND jour = :day";
    $params[':day'] = $_GET['day'];
}

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM cours WHERE supprime = 0" . 
    (empty($_GET['galop']) ? '' : " AND libcours LIKE :galop") .
    (empty($_GET['hour']) ? '' : " AND hdebut LIKE :hour") .
    (empty($_GET['day']) ? '' : " AND jour = :day"));
$countStmt->execute($params);
$totalItems = $countStmt->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

$query .= " LIMIT :offset, :limit";
$stmt = $pdo->prepare($query);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'courses' => $courses,
    'currentPage' => $page,
    'totalPages' => $totalPages
]);
?>