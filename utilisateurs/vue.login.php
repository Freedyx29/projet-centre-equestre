<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Connexion - Les Crins d'Or</title>
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
            max-width: 450px;
            background: var(--glass-bg);
            padding: 50px 40px;
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
            margin-bottom: 30px;
        }

        .logo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--accent-color);
            padding: 5px;
            margin-bottom: 20px;
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
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
            font-size: 3em;
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
            margin-bottom: 25px;
            position: relative;
        }

        .form-control {
            height: 60px;
            padding-left: 55px;
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            transition: all 0.4s ease;
            font-size: 17px;
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
            left: 18px;
            top: 19px;
            color: var(--accent-color);
            font-size: 20px;
            transition: all 0.4s ease;
        }

        /* Styles du bouton */
        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            border: none;
            width: 100%;
            height: 60px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.5s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
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
            margin: 20px 0;
        }

        .welcome-text {
            text-align: center;
            color: var(--text-color);
            margin-bottom: 20px;
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
    margin: 20px 0;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.decorative-line::before,
.decorative-line::after {
    content: "♞";
    position: absolute;
    font-size: 24px;
    color: var(--accent-color);
    text-shadow: 0 0 10px rgba(210, 105, 30, 0.5);
}

.decorative-line::before {
    left: 20%;
    transform: scaleX(-1);
}

.decorative-line::after {
    right: 20%;
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
            <h2>Equihorizon</h2>
            <p class="welcome-text">Bienvenue sur votre espace de gestion</p>
            
            <div class="decorative-line"></div>

            <!-- Error message display -->
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error_message']; ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
            
            <form action="login.php" method="POST" class="fh5co-form">
                <input type="hidden" name="redirect_to" value="<?php echo isset($_GET['redirect_to']) ? htmlspecialchars($_GET['redirect_to']) : '../vue/vue.race.php'; ?>">
                
                <div class="form-group">
                    <input type="email" class="form-control" id="mailuti" name="mailuti" 
                           placeholder="Votre email" required autocomplete="off">
                    <i class="fas fa-user"></i>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="mdputi" name="mdputi" 
                           placeholder="Votre mot de passe" required autocomplete="off">
                    <i class="fas fa-lock"></i>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </button>
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
            $('.btn-primary').hover(
                function() { $(this).addClass('animate__animated animate__pulse'); },
                function() { $(this).removeClass('animate__animated animate__pulse'); }
            );

            // Initialisation des particules
            createParticles();
        });
    </script>
</body>
</html>
