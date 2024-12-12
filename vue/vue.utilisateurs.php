<?php
session_start();
include_once '../class/class.cavaliers.php';

// Vérifiez si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Créez une instance de la classe Cavaliers
    $cavalier = new Cavaliers();

    // Vérifiez les identifiants
    $user = $cavalier->verifyCredentials($email, $password);

    if ($user) {
        // Stockez l'ID utilisateur dans la session
        $_SESSION['iduti'] = $user['idcava'];

        // Set a welcome message
        $_SESSION['welcome_message'] = "Bienvenue, " . $user['prenomcava'] . "!";

        // Redirigez vers vue.calendrier.php
        header('Location: vue.calendrier.php');
        exit();
    } else {
        $error_message = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Connexion Cavalier - Les Crins d'Or</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS externes -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Variables CSS */
        :root {
            --primary-color: #A0522D;
            --secondary-color: #8B4513;
            --accent-color: #D2691E;
            --text-color: #FFFFFF;
            --error-color: #DC3545;
            --success-color: #28A745;
            --white: #FFFFFF;
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        /* Styles de base */
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                            url('../photos/rider.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Lora', serif;
            color: var(--text-color);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Container principal */
        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        /* Formulaire et conteneur */
        .form-container {
            width: 100%;
            max-width: 360px; /* Réduit la largeur maximale */
            background: var(--glass-bg);
            padding: 30px 20px; /* Réduit le padding */
            border-radius: 25px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2),
                        0 0 30px rgba(160, 82, 45, 0.3);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            animation: fadeInUp 1s ease, glowPulse 3s infinite;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        /* Logo et animations */
        .logo-container {
            text-align: center;
            margin-bottom: 20px; /* Réduit la marge inférieure */
        }

        .logo {
            width: 120px; /* Réduit la largeur du logo */
            height: 120px; /* Réduit la hauteur du logo */
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--accent-color);
            padding: 5px;
            margin-bottom: 15px; /* Réduit la marge inférieure */
            animation: logoPulse 3s infinite;
            box-shadow: 0 0 30px rgba(210, 105, 30, 0.3);
        }

        /* Animations */
        @keyframes logoPulse {
            0% { transform: scale(1); box-shadow: 0 0 30px rgba(210, 105, 30, 0.3); }
            50% { transform: scale(1.05); box-shadow: 0 0 50px rgba(210, 105, 30, 0.5); }
            100% { transform: scale(1); box-shadow: 0 0 30px rgba(210, 105, 30, 0.3); }
        }

        @keyframes glowPulse {
            0% { box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2); }
            50% { box-shadow: 0 25px 45px rgba(160, 82, 45, 0.3); }
            100% { box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2); }
        }

        /* Styles du titre et texte */
        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 15px; /* Réduit la marge inférieure */
            font-family: 'Playfair Display', serif;
            font-size: 2.5em; /* Réduit la taille de la police */
            font-weight: 600;
            text-shadow: 2px 2px 4px rgba(160, 82, 45, 0.3);
            transition: color 0.3s ease, text-shadow 0.3s ease;
        }

        h2:hover {
            color: var(--accent-color);
            text-shadow: 2px 2px 8px rgba(210, 105, 30, 0.5);
        }

        /* Styles du formulaire */
        .form-group {
            margin-bottom: 20px; /* Réduit la marge inférieure */
            position: relative;
        }

        .form-control {
            height: 50px; /* Réduit la hauteur des champs de saisie */
            padding-left: 45px; /* Réduit le padding gauche */
            border: 1px solid var(--glass-border);
            border-radius: 10px; /* Réduit le rayon des coins */
            transition: all 0.4s ease;
            font-size: 15px; /* Réduit la taille de la police */
            background: var(--glass-bg);
            color: var(--text-color);
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 20px rgba(210, 105, 30, 0.2);
            background: rgba(255, 255, 255, 0.2);
        }

        .form-group i {
            position: absolute;
            left: 15px; /* Réduit la position gauche */
            top: 15px; /* Réduit la position supérieure */
            color: var(--accent-color);
            font-size: 18px; /* Réduit la taille de la police */
            transition: all 0.4s ease;
        }

        /* Styles du bouton */
        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            border: none;
            width: 100%;
            height: 50px; /* Réduit la hauteur du bouton */
            font-size: 18px; /* Réduit la taille de la police */
            font-weight: bold;
            border-radius: 8px; /* Réduit le rayon des coins */
            cursor: pointer;
            transition: all 0.5s ease;
            text-transform: uppercase;
            letter-spacing: 1px; /* Réduit l'espacement des lettres */
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(160, 82, 45, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(160, 82, 45, 0.5);
            background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                120deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transition: 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Styles des particules */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 140, 0, 0.8);
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat 3s infinite ease-in-out;
            box-shadow: 0 0 5px #FFA500,
                       0 0 10px #FFA500,
                       0 0 15px #FFA500;
        }

        @keyframes particleFloat {
            0%, 100% {
                transform: translateY(0) scale(1);
                opacity: 0.8;
            }
            50% {
                transform: translateY(-20px) scale(1.2);
                opacity: 1;
            }
        }

        /* Éléments additionnels */
        .decorative-line {
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin: 15px 0; /* Réduit la marge */
        }

        .welcome-text {
            text-align: center;
            color: var(--text-color);
            margin-bottom: 15px; /* Réduit la marge inférieure */
            font-style: italic;
        }

        /* Styles des placeholders et inputs */
        .form-control::placeholder {
            color: var(--white);
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .form-control:focus::placeholder {
            opacity: 0.5;
        }

        input[type="email"],
        input[type="password"] {
            color: white !important;
        }
        .decorative-line {
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            margin: 15px 0; /* Réduit la marge */
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .decorative-line::before,
        .decorative-line::after {
            content: "♞";
            position: absolute;
            font-size: 20px; /* Réduit la taille de la police */
            color: var(--accent-color);
            text-shadow: 0 0 10px rgba(210, 105, 30, 0.5);
        }

        .decorative-line::before {
            left: 15%; /* Réduit la position gauche */
            transform: scaleX(-1);
        }

        .decorative-line::after {
            right: 15%; /* Réduit la position droite */
        }
/* Styles du bouton principal */
.btn-primary {
    background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
    border: none;
    width: 100%;
    height: 40px; /* Réduit la hauteur du bouton */
    font-size: 16px; /* Réduit la taille de la police */
    font-weight: bold;
    border-radius: 6px; /* Réduit le rayon des coins */
    cursor: pointer;
    transition: all 0.5s ease;
    text-transform: uppercase;
    letter-spacing: 1px; /* Réduit l'espacement des lettres */
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(160, 82, 45, 0.3);
    padding: 5px 10px; /* Réduit le padding */
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(160, 82, 45, 0.5);
    background: linear-gradient(45deg, var(--accent-color), var(--primary-color));
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(255, 255, 255, 0.3),
        transparent
    );
    transition: 0.5s;
}

.btn-primary:hover::before {
    left: 100%;
}

/* Styles du bouton secondaire */
.btn-secondary {
    background: linear-gradient(45deg, #6c757d, #adb5bd); /* Gris foncé à gris clair */
    border: none;
    width: 100%;
    height: 40px; /* Réduit la hauteur du bouton */
    font-size: 16px; /* Réduit la taille de la police */
    font-weight: bold;
    border-radius: 6px; /* Réduit le rayon des coins */
    cursor: pointer;
    transition: all 0.5s ease;
    text-transform: uppercase;
    letter-spacing: 1px; /* Réduit l'espacement des lettres */
    position: relative;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3); /* Ombre grise */
    margin-top: 10px; /* Ajoute une marge pour séparer les boutons */
    padding: 5px 10px; /* Réduit le padding */
}

.btn-secondary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(108, 117, 125, 0.5); /* Ombre grise plus intense */
    background: linear-gradient(45deg, #adb5bd, #6c757d); /* Gris clair à gris foncé */
}

.btn-secondary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        120deg,
        transparent,
        rgba(255, 255, 255, 0.3),
        transparent
    );
    transition: 0.5s;
}

.btn-secondary:hover::before {
    left: 100%;
}

    </style>
</head>
<body>
    <div class="particles" id="particles"></div>
    <div class="container">
        <div class="form-container">
            <div class="logo-container">
                <img src="../photos/equi.png" alt="Logo Les Crins d'Or" class="logo">
            </div>
            <h2>Connexion Cavalier</h2>
            <p class="welcome-text">Connectez-vous avec vos identifiants</p>

            <div class="decorative-line"></div>

<form action="" method="POST" class="fh5co-form">
    <!-- Affichez le message d'erreur si les identifiants sont incorrects -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <div class="form-group">
        <input type="email" class="form-control" id="email" name="email"
               placeholder="Votre email" required autocomplete="off">
        <i class="fas fa-user"></i>
    </div>

    <div class="form-group">
        <input type="password" class="form-control" id="password" name="password"
               placeholder="Votre mot de passe" required autocomplete="off">
        <i class="fas fa-lock"></i>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i> Se connecter
        </button>
        <a href="index.html" class="btn btn-secondary">
            <i class="fas fa-home"></i> Retour à l'accueil
        </a>
    </div>
</form>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
 $(document).ready(function() {
    // Fonction de création des particules
    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        const particleCount = 100;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';

            const size = Math.random() * 2 + 1;
            const duration = Math.random() * 3 + 2;
            const opacity = Math.random() * 0.3 + 0.7;

            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.left = `${Math.random() * 100}vw`;
            particle.style.top = `${Math.random() * 100}vh`;
            particle.style.animation = `particleFloat ${duration}s infinite ease-in-out`;
            particle.style.opacity = opacity;
            particle.style.background = `rgba(255, 140, 0, ${opacity})`;

            particlesContainer.appendChild(particle);
        }
    }

    // Animation des icônes au focus
    $('.form-control').focus(function() {
        $(this).siblings('i').addClass('animate__animated animate__pulse');
    }).blur(function() {
        $(this).siblings('i').removeClass('animate__animated animate__pulse');
    });

    // Animation du bouton au hover
    $('.btn-primary, .btn-secondary').hover(
        function() { $(this).addClass('animate__animated animate__pulse'); },
        function() { $(this).removeClass('animate__animated animate__pulse'); }
    );

    // Initialisation des particules
    createParticles();
});

    </script>
</body>
</html>
