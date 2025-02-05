<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre Équestre EquiHorizon</title>
    <link rel="stylesheet" href="../Equisite/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="#accueil">
                <img src="../photos/equip.png" alt="EquiHorizon Logo">
            </a>
        </div>
        <div class="nav-container">
            <ul class="nav-links">
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#equipe">A propos</a></li>
                <li><a href="#services">Cavaliers</a></li>
                <li><a href="#installations">Cavalerie</a></li>
                <li><a href="#equipe">Cours</a></li>
                <li><a href="#equipe">Evenements</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="connexion.php" class="btn-auth login">
                    <i class="fas fa-user"></i>
                    <span>Connexion</span>
                </a>
            </div>
        </div>
    </nav>

    <header id="accueil" class="hero">
        <div class="hero-content">
            <h1>Bienvenue à EquiHorizon</h1>
            <p>Découvrez l'art de l'équitation dans un cadre exceptionnel</p>
            <a href="#contact" class="cta-button">Réserver un cours</a>
        </div>
    </header>

    <section id="services" class="services">
    <h2>Nos Services</h2>
    <div class="services-grid">
        <div class="service-card">
            <i class="fas fa-horse"></i>
            <h3>Cours d'Équitation</h3>
            <p>Cours particuliers et collectifs pour tous niveaux</p>
        </div>
        
        <div class="service-card">
            <i class="fas fa-tree"></i>
            <h3>Balades</h3>
            <p>Promenades guidées en pleine nature</p>
        </div>
        
        <div class="service-card">
            <i class="fas fa-graduation-cap"></i>
            <h3>Formation</h3>
            <p>Préparation aux examens fédéraux</p>
        </div>
        
        <div class="service-card">
            <i class="fas fa-home"></i>
            <h3>Pension</h3>
            <p>Hébergement et soins pour votre cheval</p>
        </div>

        <div class="service-card">
            <i class="fas fa-calendar-alt"></i>
            <h3>Événements</h3>
            <p>Concours, stages et animations équestres</p>
        </div>

        <div class="service-card">
            <i class="fas fa-camera"></i>
            <h3>Galerie Photos</h3>
            <p>Découvrez nos installations et activités</p>
        </div>
    </div>
</section>

    <section id="installations" class="installations">
        <h2>Nos Installations</h2>
        <div class="gallery">
            <div class="gallery-item">
                <img src="../photos/c1.png" alt="Carrière">
                <h3>Carrière</h3>
            </div>
            <div class="gallery-item">
                <img src="../photos/c2.png" alt="Manège couvert">
                <h3>Manège couvert</h3>
            </div>
            <div class="gallery-item">
                <img src="../photos/c3.png" alt="Écuries">
                <h3>Écuries</h3>
            </div>
        </div>
    </section>

    <section id="equipe" class="team">
        <div class="container">
            <h2 class="section-title">Notre Équipe</h2>
            <div class="team-grid">
                <div class="team-member reveal">
                    <div class="member-image">
                        <img src="Sophie.jpg" alt="Sophie">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Sophie Dupont</h3>
                        <span class="position">Monitrice BPJEPS</span>
                        <p class="bio">Passionnée d'équitation depuis son plus jeune âge, Sophie transmet son savoir avec enthousiasme et professionnalisme.</p>
                    </div>
                </div>

                <div class="team-member reveal">
                    <div class="member-image">
                        <img src="Marc.jpg" alt="Marc">
                        <div class="social-links">
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h3>Marc Laurent</h3>
                        <span class="position">Instructeur d'équitation</span>
                        <p class="bio">Expert en dressage et saut d'obstacles, Marc accompagne les cavaliers dans leur progression technique.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact">
        <h2>Contactez-nous</h2>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Informations</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Route des Écuries, 75000 Paris</p>
                <p><i class="fas fa-phone"></i> 01 23 45 67 89</p>
                <p><i class="fas fa-envelope"></i> contact@lescrindor.fr</p>
            </div>
            <form class="contact-form">
                <input type="text" placeholder="Nom" required>
                <input type="email" placeholder="Email" required>
                <textarea placeholder="Message" required></textarea>
                <button type="submit" class="cta-button">Envoyer</button>
            </form>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>EquiHorizon</h3>
                <p>Centre équestre de qualité depuis 1990</p>
            </div>
            <div class="footer-section">
                <h3>Horaires</h3>
                <p>Lundi - Samedi : 8h - 19h</p>
                <p>Dimanche : 9h - 18h</p>
            </div>
            <div class="footer-section social-media">
                <h3>Suivez-nous</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 EquiHorizon - Tous droits réservés</p>
        </div>
    </footer>

    <script>
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach((element) => {
        observer.observe(element);
    });
    </script>
</body>
</html>
