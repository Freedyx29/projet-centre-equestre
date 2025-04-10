<?php
session_start();

try {
    // Connexion à la base de données
   require_once('../include/bdd.inc.php');
    $con = connexionPDO();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier que les champs ne sont pas vides
        if (empty($_POST['mailadmin']) || empty($_POST['passwordadmin'])) {
            header("Location: ../vue/index.php?error=Veuillez remplir tous les champs");
            exit();
        }
        
        $mailadmin = filter_var($_POST['mailadmin'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['passwordadmin'];
        
        // Vérifier que l'email est valide
        if (!filter_var($mailadmin, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../vue/index.php?error=Email invalide");
            exit();
        }
        
        // Récupérer l'URL de redirection depuis un champ caché
        $redirect_to = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : '../vue/vue.race.php';

        // Requête pour récupérer le mot de passe haché
        $sql = "SELECT idadmin, nomadmin, prenomadmin, passwordadmin FROM administrateurs WHERE mailadmin = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$mailadmin]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            // Vérifier le mot de passe
            if (password_verify($password, $admin['passwordadmin'])) {
                // Mot de passe correct, création des variables de session
                $_SESSION['idadmin'] = $admin['idadmin'];
                $_SESSION['nomadmin'] = $admin['nomadmin'];
                $_SESSION['prenomadmin'] = $admin['prenomadmin'];
                
                // Redirection vers la page d'origine
                header("Location: " . $redirect_to . "?success=1&message=Bienvenue " . urlencode($admin['prenomadmin'] . " " . $admin['nomadmin']));
                exit();
            } else {
                // Mot de passe incorrect
                header("Location: ../vue/index.php?error=Mot de passe incorrect&redirect_to=" . urlencode($redirect_to));
                exit();
            }
        } else {
            // Utilisateur non trouvé
            header("Location: ../vue/index.php?error=Administrateur non trouvé&redirect_to=" . urlencode($redirect_to));
            exit();
        }
    }
} catch(PDOException $e) {
    header("Location: ../vue/index.php?error=Erreur de connexion à la base de données");
    exit();
}
?>