<?php
session_start(); // Démarrer la session
include '../include/bdd.inc.php'; // Inclure le fichier de connexion à la BDD

if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $mailuti = $_POST['mailuti'];
    $mdputi = $_POST['mdputi'];

    // Connexion à la BDD avec PDO
    $conn = connexionPDO();

    // Préparer la requête pour récupérer l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE mailuti = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$mailuti]);

    if ($stmt->rowCount() > 0) {
        // L'utilisateur existe, vérifier le mot de passe
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Debug : Afficher le mot de passe saisi et le haché pour voir la différence
        echo "Mot de passe saisi : $mdputi<br>";
        echo "Mot de passe haché dans la BDD : " . $user['mdputi'] . "<br>";

        if (password_verify($mdputi, $user['mdputi'])) {
            // Mot de passe correct, sauvegarder les infos en session
            $_SESSION['iduti'] = $user['iduti'];
            $_SESSION['nomuti'] = $user['nomuti'];
            $_SESSION['prenomuti'] = $user['prenomuti'];

            echo "Connexion réussie !";
            // Redirection ou suite de la logique
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun utilisateur trouvé avec cet e-mail.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        /* Copié et adapté du CSS fourni */

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #444;
        }

        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('cow.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            z-index: -1;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        h2 {
            font-family: 'Playfair Display', serif;
            font-size: 36px;
            margin-bottom: 20px;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .btn-retour {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn-retour:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="background-image">
        <div class="overlay"></div>
    </div>

    <div class="container">
        <h2>Connexion</h2>
      <form method="post" action="">
    <div class="form-group">
        <label for="mailuti">Email :</label>
        <input type="email" name="mailuti" required autocomplete="off">
    </div>
    <div class="form-group">
        <label for="mdputi">Mot de passe :</label>
        <input type="password" name="mdputi" required autocomplete="off">
    </div>
    <input type="submit" name="submit" value="Se connecter">
</form>

        <a href="index.php" class="btn-retour"><span class="icone-maison">&#127968;</span> Retour à la page d'accueil</a>
    </div>
</body>
</html>
