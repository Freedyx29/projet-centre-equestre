<?php
require_once 'class.cours.php';

$cours = new Cours();

if (isset($_POST['create'])) {
    $libcours = $_POST['libcours'];
    $hdebut = $_POST['hdebut'];
    $hfin = $_POST['hfin'];
    $success = $cours->create($libcours, $hdebut, $hfin) ? 1 : 0;
    header("Location: vue.cours.php?success=$success");
}

if (isset($_POST['update'])) {
    $idcours = $_POST['idcours'];
    $libcours = $_POST['libcours'];
    $hdebut = $_POST['hdebut'];
    $hfin = $_POST['hfin'];
    $success = $cours->update($idcours, $libcours, $hdebut, $hfin) ? 1 : 0;
    header("Location: vue.cours.php?success=$success");
}

if (isset($_POST['delete'])) {
    $idcours = $_POST['idcours'];
    $success = $cours->delete($idcours) ? 1 : 0;
    header("Location: vue.cours.php?success=$success");
}
?>
