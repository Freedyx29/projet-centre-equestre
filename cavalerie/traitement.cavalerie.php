<?php

include 'class.cavalerie.php';

$cavalerie = new Cavalerie();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numsire = $_POST['numsire'] ?? null;
    $nomche = $_POST['nomche'];
    $datenache = $_POST['datenache'];
    $garrot = $_POST['garrot'];
    $idrace = $_POST['idrace_id'];
    $idrobe = $_POST['idrobe_id'];

    if ($numsire) {
        $success = $cavalerie->updateCavalier($numsire, $nomche, $datenache, $garrot, $idrace, $idrobe) ? 1 : 0;
    } else {
        $success = $cavalerie->addCavalier($nomche, $datenache, $garrot, $idrace, $idrobe) ? 1 : 0;
    }
    
    header("Location: vue.cavalerie.php?success=$success");
    exit();
}

if (isset($_GET['delete'])) {
    $numsire = $_GET['delete'];
    $success = $cavalerie->deleteCavalier($numsire) ? 1 : 0;
    header("Location: vue.cavalerie.php?success=$success");
    exit();
}

?>
