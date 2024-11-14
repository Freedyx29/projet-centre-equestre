<?php
require_once 'class.cours.php';

$cours = new Cours();

if (isset($_POST['create'])) {
    // Vérification des champs
    $libcours = isset($_POST['libcours']) ? $_POST['libcours'] : null;
    $hdebut = isset($_POST['hdebut']) ? $_POST['hdebut'] : null;
    $hfin = isset($_POST['hfin']) ? $_POST['hfin'] : null;
    $jour = isset($_POST['jour']) ? $_POST['jour'] : null;

    // Vérification si les valeurs sont définies
    if ($libcours && $hdebut && $hfin && $jour) {
        $success = $cours->create($libcours, $hdebut, $hfin, $jour) ? 1 : 0;
        header("Location: vue.cours.php?success=$success");
    } else {
        // Gérer le cas où une des valeurs est manquante
        echo "Erreur : Tous les champs doivent être remplis.";
    }
}

if (isset($_POST['update'])) {
    $idcours = $_POST['idcours'];
    $libcours = $_POST['libcours'];
    $hdebut = $_POST['hdebut'];
    $hfin = $_POST['hfin'];
    $jour = $_POST['jour'];
    $success = $cours->update($idcours, $libcours, $hdebut, $hfin, $jour) ? 1 : 0;
    header("Location: vue.cours.php?success=$success");
}

if (isset($_POST['delete'])) {
    $idcours = $_POST['idcours'];
    $success = $cours->delete($idcours) ? 1 : 0;
    header("Location: vue.cours.php?success=$success");
}
?>
