<?php
// Démarrer la session
session_start();

// Connexion à la base de données
$servername = "localhost"; // Remplace par ton serveur si nécessaire
$username = "root"; // Remplace par ton utilisateur
$password = ""; // Remplace par ton mot de passe
$dbname = "equihorizon"; // Remplace par le nom de ta base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$mailuti = $_POST['mailuti']; // Récupérer l'email
$password = $_POST['mdputi']; // Récupérer le mot de passe

// Requête pour récupérer le mot de passe haché
$sql = "SELECT iduti, nomuti, prenomuti, mdputi FROM utilisateurs WHERE mailuti = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mailuti);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // L'utilisateur existe
    $row = $result->fetch_assoc();
    $hashed_password = $row['mdputi']; // Mot de passe haché de la base de données

    // Vérifier le mot de passe
    if (password_verify($password, $hashed_password)) {
        // Mot de passe correct
        // Enregistrer les informations de l'utilisateur dans la session
        $_SESSION['iduti'] = $row['iduti'];
        $_SESSION['nomuti'] = $row['nomuti'];
        $_SESSION['prenomuti'] = $row['prenomuti'];

        echo "Connexion réussie!";
       
    } else {
        // Mot de passe incorrect
        echo "Erreur: Mot de passe incorrect.";
    }
} else {
    echo "Erreur: Utilisateur non trouvé.";
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
