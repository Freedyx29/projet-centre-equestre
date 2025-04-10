<?php
require_once '../include/bdd.inc.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - Centre Équestre EquiHorizon</title>
    <link rel="stylesheet" href="../Equisite/css/propos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
<nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="../photos/equip.png" alt="EquiHorizon Logo">
            </a>
        </div>
        <div class="nav-container">
            <ul class="nav-links">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="propos.php">À propos</a></li>
                <li><a href="cavaliers.php">Cavaliers</a></li>
                <li><a href="cavalerie.php">Cavalerie</a></li>
                <li><a href="cours.php">Cours</a></li>
                <li><a href="evenements.php">Événements</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="vue.utilisateurs.php" class="btn-auth login">
                    <i class="fas fa-user"></i>
                    <span>Connexion</span>
                </a>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <h1>À Propos d'EquiHorizon</h1>
            <p>Une passion pour les chevaux depuis 1990</p>
        </div>
    </section>

    <section class="about-us">
        <div class="container">
            <h2>Notre Histoire</h2>
            <div class="about-content">
                <div class="about-text reveal">
                    <p>Fondé en 1990 par Marie et Jean Dupont, le Centre Équestre EquiHorizon est né d’une passion commune pour les chevaux et la nature. Situé au cœur de la campagne de Brive-la-Gaillarde, notre centre a grandi au fil des années pour devenir un lieu incontournable pour les amoureux de l’équitation, qu’ils soient débutants ou cavaliers confirmés.</p>
                    <p>Avec une philosophie centrée sur le bien-être des chevaux et l’épanouissement des cavaliers, EquiHorizon combine tradition et modernité. Nos installations de pointe et notre équipe dévouée travaillent main dans la main pour offrir une expérience unique à chaque visiteur.</p>
                </div>
                <div class="about-image reveal">
                    <img src="../photos/rider.jpg" alt="Écuries EquiHorizon">
                </div>
            </div>
        </div>
    </section>

    <section class="values">
        <h2>Nos Valeurs</h2>
        <div class="values-grid">
            <div class="value-card reveal">
                <i class="fas fa-heart"></i>
                <h3>Passion</h3>
                <p>Nous vivons pour les chevaux et transmettons cet amour à chaque cavalier.</p>
            </div>
            <div class="value-card reveal">
                <i class="fas fa-users"></i>
                <h3>Communauté</h3>
                <p>Un lieu d’échange et de partage pour tous les passionnés d’équitation.</p>
            </div>
            <div class="value-card reveal">
                <i class="fas fa-leaf"></i>
                <h3>Respect</h3>
                <p>Respect des animaux, de la nature et de chaque individu qui franchit nos portes.</p>
            </div>
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
                <p>Du Lundi au Samedi</p>
                <p>Dimanche le matin</p>
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
