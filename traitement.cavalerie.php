<?php
include('../include/bdd.inc.php');
$conn = connexionPDO();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomche = $_POST['nomche'];
    $datenache = $_POST['datenache'];
    $garrot = $_POST['garrot'];
    $idrace = $_POST['idrace_hidden'];
    $idrobe = $_POST['idrobe_hidden'];

    // Vérification de l'existence de la race
    $stmt = $conn->prepare("SELECT COUNT(*) FROM race WHERE idrace = ?");
    $stmt->execute([$idrace]);
    if ($stmt->fetchColumn() == 0) {
        die("La race sélectionnée n'existe pas.");
    }

    // Vérification de l'existence de la robe
    $stmt = $conn->prepare("SELECT COUNT(*) FROM robe WHERE idrobe = ?");
    $stmt->execute([$idrobe]);
    if ($stmt->fetchColumn() == 0) {
        die("La robe sélectionnée n'existe pas.");
    }

    // Insertion du cavalier
    $stmt = $conn->prepare("INSERT INTO cavalerie (nomche, datenache, garrot, idrace, idrobe) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nomche, $datenache, $garrot, $idrace, $idrobe]);

    echo "Cavalier ajouté avec succès.";
    header("Location: vue.cavalerie.php");
    exit();
}
