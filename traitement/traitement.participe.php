<?php
include '../includes/bdd.inc.php';
include 'competition.class.php';

if (!isset($con)) {
    die('Erreur de connexion à la base de données.');
}

$oCompetition = new Competition($con);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomCompet = $_POST['nom_competition'];
    $dateCompet = $_POST['date_competition'];
    $idCom = $_POST['idcom']; // Assurez-vous que ce champ existe

    if (empty($nomCompet) || empty($dateCompet) || empty($idCom)) {
        echo "Erreur : tous les champs sont requis.";
        exit();
    }

    try {
        if (isset($_POST['ajouter'])) {
            $oCompetition->Competition_ajout($nomCompet, $dateCompet, $idCom);
        } elseif (isset($_POST['modifier']) && !empty($_POST['id_competition'])) {
            $oCompetition->Competition_modifier($_POST['id_competition'], $nomCompet, $dateCompet, $idCom);
        }
        header("Location: vue.competition.php");
        exit();
    } catch (PDOException $e) {
        echo 'Erreur SQL : ' . $e->getMessage();
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id_competition'])) {
    $idCompetition = $_GET['id_competition'];
    try {
        $oCompetition->Competition_supprimer($idCompetition);
        header("Location: vue.competition.php");
        exit();
    } catch (PDOException $e) {
        echo 'Erreur SQL : ' . $e->getMessage();
    }
}
?>
