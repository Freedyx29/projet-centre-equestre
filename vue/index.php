<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <title>Connexion - EquiHorizon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS externes -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600&family=Playfair+Display:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style_index.css">
</head>
<body>
    <div class="particles" id="particles"></div>
    <div class="container">
        <div class="form-container">
            <div class="logo-container">
                <img src="../photos/equi.png" alt="Logo EquiHorizon" class="logo">
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
            
            <form action="../administrateurs/login.php" method="POST" class="fh5co-form">
                <input type="hidden" name="redirect_to" value="<?php echo isset($_GET['redirect_to']) ? htmlspecialchars($_GET['redirect_to']) : '../vue/vue.race.php'; ?>">
                
                <div class="form-group">
                    <input type="email" class="form-control" id="mailadmin" name="mailadmin" 
                           placeholder="Votre email" required autocomplete="off">
                    <i class="fas fa-user"></i>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="passwordadmin" name="passwordadmin" 
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
