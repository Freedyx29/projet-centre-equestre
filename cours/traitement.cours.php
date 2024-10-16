<?php
require_once 'class.cours.php';

$cours = new Cours();

// Créer un cours
if (isset($_POST['create'])) {
    $libcours = $_POST['libcours'];
    $hdebut = $_POST['hdebut'];
    $hfin = $_POST['hfin'];
    $cours->create($libcours, $hdebut, $hfin);
    header('Location: vue.cours.php'); // Rediriger vers la vue
}

// Mettre à jour un cours
if (isset($_POST['update'])) {
    $idcours = $_POST['idcours'];
    $libcours = $_POST['libcours'];
    $hdebut = $_POST['hdebut'];
    $hfin = $_POST['hfin'];
    $cours->update($idcours, $libcours, $hdebut, $hfin);
    header('Location: vue.cours.php'); // Rediriger vers la vue
}

// Supprimer un cours
if (isset($_GET['delete'])) {
    $idcours = $_GET['delete'];
    $cours->delete($idcours);
    header('Location: vue.cours.php'); // Rediriger vers la vue
}
?>
