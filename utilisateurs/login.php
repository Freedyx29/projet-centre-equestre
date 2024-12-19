<?php
session_start();

try {
    // Connexion à la base de données
   require_once('../include/bdd.inc.php');
    $con = connexionPDO();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier que les champs ne sont pas vides
        if (empty($_POST['mailuti']) || empty($_POST['mdputi'])) {
            header("Location: ../vue/index.php?error=Veuillez remplir tous les champs");
            exit();
        }
        
        $mailuti = filter_var($_POST['mailuti'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['mdputi'];
        
        // Vérifier que l'email est valide
        if (!filter_var($mailuti, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../vue/index.php?error=Email invalide");
            exit();
        }
        
        // Récupérer l'URL de redirection depuis un champ caché
        $redirect_to = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : '../vue/vue.race.php';

        // Requête pour récupérer le mot de passe haché
        $sql = "SELECT iduti, nomuti, prenomuti, mdputi FROM utilisateurs WHERE mailuti = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$mailuti]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifier le mot de passe
            if (password_verify($password, $user['mdputi'])) {
                // Mot de passe correct, création des variables de session
                $_SESSION['iduti'] = $user['iduti'];
                $_SESSION['nomuti'] = $user['nomuti'];
                $_SESSION['prenomuti'] = $user['prenomuti'];
                
                // Redirection vers la page d'origine
                header("Location: " . $redirect_to . "?success=1&message=Bienvenue " . urlencode($user['prenomuti'] . " " . $user['nomuti']));
                exit();
            } else {
                // Mot de passe incorrect
                header("Location: ../vue/index.php?error=Mot de passe incorrect&redirect_to=" . urlencode($redirect_to));
                exit();
            }
        } else {
            // Utilisateur non trouvé
            header("Location: ../vue/index.php?error=Utilisateur non trouvé&redirect_to=" . urlencode($redirect_to));
            exit();
        }
    }
} catch(PDOException $e) {
    header("Location: ../vue/index.php?error=Erreur de connexion à la base de données");
    exit();
}
?>