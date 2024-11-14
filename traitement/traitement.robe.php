<?php 

include 'class.robe.php';

$oRobe = new Robe();

if (isset($_POST['ajouter'])) {
    $librobe = $_POST['librobe'];
    $success = $oRobe->robeAjout($librobe) ? 1 : 0; // Call the add method
    header("Location: vue.robe.php?success=$success"); // Redirect with success status
    exit(); // Stop execution
}

if (isset($_POST['modifier'])) {
    $idrobe = $_POST['idrobe'];
    $librobe = $_POST['librobe'];
    $success = $oRobe->Modifier($idrobe, $librobe) ? 1 : 0; // Call the modify method
    header("Location: vue.robe.php?success=$success"); // Redirect with success status
    exit(); // Stop execution
}

if (isset($_POST['supprimer'])) {
    $idrobe = $_POST['idrobe'];
    $success = $oRobe->Supprimer($idrobe) ? 1 : 0;
    header("Location: vue.robe.php?success=$success");
    exit(); // Ensure that script execution stops after the redirect
}

?>