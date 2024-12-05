<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EquiHorizon</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="navbar">
        <nav class="navbar">
            <ul class="menu">
                <li><a href="a_propos.php">A propos</a></li>
                <li><a href="cavaliers.php">Cavaliers</a></li>
                <li><a href="evenements.php">Événements</a></li>
                <li><a href="accueil.php">Accueil</a></li>
                <li class="logo-item">
                    <a href="index.php">
                        <img src="../photos/equi.png" alt="Logo EquiHorizon" class="logo-image">
                    </a>
                </li>
                <li><a href="cours.php">Cours</a></li>
                <li><a href="cavalerie.php">Cavalerie</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="espace_personnel.php">Espace personnel</a></li>
            </ul>
        </nav>
    </header>

    <!-- Nouvelle section Hero avec image -->
    <section class="hero">
        <img src="../photos/c3.png" alt="Image d'accueil" class="hero-image">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Bienvenue à EquiHorizon</h1>
            <p>Découvrez l'art de l'équitation dans un cadre d'exception</p>
            <div class="hero-buttons">
                <a href="essai.php" class="btn-primary">Réserver un cours d'essai</a>
                <a href="installations.php" class="btn-secondary">Découvrir nos installations</a>
            </div>
        </div>
    </section>

    <!-- Section Chiffres Clés -->
    <section class="key-figures">
        <div class="figure-item" data-aos="fade-up">
            <i class="fas fa-horse"></i>
            <span class="number">30</span>
            <p>Chevaux et poneys</p>
        </div>
        <div class="figure-item" data-aos="fade-up" data-aos-delay="100">
            <i class="fas fa-user-tie"></i>
            <span class="number">5</span>
            <p>Moniteurs diplômés</p>
        </div>
        <div class="figure-item" data-aos="fade-up" data-aos-delay="200">
            <i class="fas fa-users"></i>
            <span class="number">300</span>
            <p>Cavaliers réguliers</p>
        </div>
        <div class="figure-item" data-aos="fade-up" data-aos-delay="300">
            <i class="fas fa-tree"></i>
            <span class="number">15</span>
            <p>Hectares d'installations</p>
        </div>
    </section>

    <!-- Section Disciplines -->
    <section class="disciplines">
        <h2>Nos Disciplines</h2>
        <div class="disciplines-grid">
            <div class="discipline-card">
                <img src="../photos/c1.png" alt="CSO">
                <h3>Saut d'obstacles</h3>
                <p>Du débutant à la compétition</p>
            </div>
            <div class="discipline-card">
                <img src="../photos/c2.png" alt="Dressage">
                <h3>Dressage</h3>
                <p>Maîtrise et élégance</p>
            </div>
            <div class="discipline-card">
                <img src="../photos/c3.png" alt="Balade">
                <h3>Balades</h3>
                <p>Nature et évasion</p>
            </div>
        </div>
    </section>

    <!-- Section Actualités -->
    <section class="news">
        <h2>Nos Actualités</h2>
        <div class="news-grid">
            <article class="news-card" data-aos="fade-up">
                <img src="../photos/c1.png" alt="Stage d'été">
                <div class="news-content">
                    <h3>Stages d'été 2024</h3>
                    <p>Découvrez notre programme complet de stages pour cet été. 
                       Du débutant au confirmé, il y en a pour tous les niveaux !</p>
                    <a href="stages.php" class="read-more">En savoir plus</a>
                </div>
            </article>
            
            <article class="news-card" data-aos="fade-up" data-aos-delay="100">
                <img src="../photos/c2.png" alt="Compétition">
                <div class="news-content">
                    <h3>Concours CSO - 15 Juin</h3>
                    <p>Participez à notre prochain concours de saut d'obstacles. 
                       Épreuves Club et Amateur au programme.</p>
                    <a href="competitions.php" class="read-more">En savoir plus</a>
                </div>
            </article>
            
            <article class="news-card" data-aos="fade-up" data-aos-delay="200">
                <img src="../photos/c3.png" alt="Nouveau pensionnaire">
                <div class="news-content">
                    <h3>Nouveau Pensionnaire</h3>
                    <p>Découvrez notre nouvelle recrue : Éclair, un magnifique Pure-sang 
                       Espagnol qui rejoint notre cavalerie.</p>
                    <a href="cavalerie.php" class="read-more">En savoir plus</a>
                </div>
            </article>
        </div>
    </section>

    <!-- Votre footer existant -->
    <footer class="footer">
        <nav>
            <ul class="footer-menu">
                <li><a href="mentions_legales.php">Mentions légales</a></li>
                <li><a href="politique_confidentialite.php">Politique de confidentialité</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="footer-logo">
            <a href="index.php">
                <img src="../photos/equi.png" alt="Logo Footer" class="footer-logo-image">
            </a>
        </div>
        <div class="footer-socials">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>

    <script src="../js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html>
