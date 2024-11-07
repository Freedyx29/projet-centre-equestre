<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "equihorizon");

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Données de l'utilisateur
$mailuti = 'rouan@gmail.com';
$nomuti = 'NomTest';
$prenomuti = 'PrenomTest';
$mdputi = password_hash('BTSSIO', PASSWORD_DEFAULT); // Hachage du mot de passe

// Préparation de la requête SQL
$sql = "INSERT INTO utilisateurs (mailuti, nomuti, prenomuti, mdputi) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $mailuti, $nomuti, $prenomuti, $mdputi);
$stmt->execute();

echo "Utilisateur ajouté avec succès !";
$stmt->close();
$conn->close();
?>
