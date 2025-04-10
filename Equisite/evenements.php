<?php
require_once '../include/bdd.inc.php';

// Nombre d'événements par page
$evenementsParPage = 6;

// Récupérer la page actuelle depuis l'URL, par défaut 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1; // Empêche les pages négatives ou zéro

// Calculer l'offset pour la requête SQL
$offset = ($page - 1) * $evenementsParPage;

// Connexion à la base de données
$pdo = connexionPDO();

// Compter le nombre total d'événements non supprimés
$stmtTotal = $pdo->prepare("SELECT COUNT(*) as total FROM evenements WHERE supprime = 0");
$stmtTotal->execute();
$totalEvenements = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

// Calculer le nombre total de pages
$totalPages = ceil($totalEvenements / $evenementsParPage);
if ($totalPages < 1) $totalPages = 1; // Toujours au moins 1 page

// S'assurer que la page demandée ne dépasse pas le total
if ($page > $totalPages) $page = $totalPages;

// Récupérer les événements pour la page actuelle avec leurs photos
$stmt = $pdo->prepare("
    SELECT e.*, p.lienphoto 
    FROM evenements e 
    LEFT JOIN photos p ON e.ideve = p.ideve 
    WHERE e.supprime = 0 
    LIMIT :offset, :limit
");
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $evenementsParPage, PDO::PARAM_INT);
$stmt->execute();
$evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements - Centre Équestre EquiHorizon</title>
    <link rel="stylesheet" href="../Equisite/css/evenements.css">
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
            <h1>Nos Événements</h1>
            <p>Participez à nos événements équestres et vivez des moments inoubliables</p>
            <a href="#evenements-list" class="btn-hero">Découvrir</a>
        </div>
    </section>

    <section class="intro">
        <div class="container">
            <h2>Nos Événements à Venir</h2>
            <p>Rejoignez-nous pour des concours, stages, randonnées et bien plus encore. Chaque événement est une occasion de partager notre passion pour les chevaux et de créer des souvenirs mémorables.</p>
        </div>
    </section>

    <section id="evenements-list" class="evenements-list">
        <div class="container">
            <h2>Liste des Événements</h2>
            <div class="evenements-grid">
                <?php
                if (count($evenements) > 0) {
                    foreach ($evenements as $evenement) {
                        echo '<div class="evenement-card reveal">';
                        if ($evenement['lienphoto']) {
                            echo '<img src="' . htmlspecialchars($evenement['lienphoto']) . '" alt="' . htmlspecialchars($evenement['titre']) . '" class="evenement-photo">';
                        } else {
                            echo '<i class="fas fa-calendar-alt evenement-icon"></i>';
                        }
                        echo '<h3>' . htmlspecialchars($evenement['titre']) . '</h3>';
                        echo '<div class="evenement-info">';
                        echo '<p>' . htmlspecialchars($evenement['commentaire']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="no-evenements">Aucun événement trouvé dans la base de données.</p>';
                }
                ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="pagination-btn"><i class="fas fa-chevron-left"></i> Précédent</a>
                <?php else: ?>
                    <span class="pagination-btn disabled"><i class="fas fa-chevron-left"></i> Précédent</span>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="pagination-btn <?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="pagination-btn">Suivant <i class="fas fa-chevron-right"></i></a>
                <?php else: ?>
                    <span class="pagination-btn disabled">Suivant <i class="fas fa-chevron-right"></i></span>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="join-us">
        <div class="container">
            <h2>Participez à Nos Événements</h2>
            <p>Que vous soyez cavalier ou simple visiteur, nos événements sont ouverts à tous. Inscrivez-vous dès maintenant pour vivre des expériences uniques avec nos chevaux.</p>
            <a href="contact.php" class="btn-join">Nous Contacter</a>
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
                <p>Lundi - Samedi : 9h - 18h</p>
                <p>Dimanche : 9h - 12h</p>
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
            <p>© 2024 EquiHorizon - Tous droits réservés</p>
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
