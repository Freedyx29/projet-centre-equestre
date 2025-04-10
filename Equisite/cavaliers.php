<?php
require_once '../include/bdd.inc.php';

// Nombre de cavaliers par page
$cavaliersParPage = 6;

// Récupérer la page actuelle depuis l'URL, par défaut 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1; // Empêche les pages négatives ou zéro

// Calculer l'offset pour la requête SQL
$offset = ($page - 1) * $cavaliersParPage;

// Connexion à la base de données
$pdo = connexionPDO();

// Compter le nombre total de cavaliers non supprimés
$stmtTotal = $pdo->prepare("SELECT COUNT(*) as total FROM cavaliers WHERE supprime = 0");
$stmtTotal->execute();
$totalCavaliers = $stmtTotal->fetch(PDO::FETCH_ASSOC)['total'];

// Calculer le nombre total de pages
$totalPages = ceil($totalCavaliers / $cavaliersParPage);
if ($totalPages < 1) $totalPages = 1; // Toujours au moins 1 page

// S'assurer que la page demandée ne dépasse pas le total
if ($page > $totalPages) $page = $totalPages;

// Récupérer les cavaliers pour la page actuelle
$stmt = $pdo->prepare("SELECT * FROM cavaliers WHERE supprime = 0 LIMIT :offset, :limit");
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $cavaliersParPage, PDO::PARAM_INT);
$stmt->execute();
$cavaliers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cavaliers - Centre Équestre EquiHorizon</title>
    <link rel="stylesheet" href="../Equisite/css/cavaliers.css">
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
            <h1>Nos Cavaliers</h1>
            <p>Rencontrez les membres passionnés de notre communauté équestre</p>
            <a href="#cavaliers-list" class="btn-hero">Découvrir</a>
        </div>
    </section>

    <section class="intro">
        <div class="container">
            <h2>Une Communauté Vibrante</h2>
            <p>Chez EquiHorizon, nos cavaliers forment le cœur de notre centre. Des débutants aux compétiteurs aguerris, chacun apporte sa passion et son énergie à notre grande famille équestre. Découvrez leurs profils, leurs parcours et leur engagement dans cet univers unique.</p>
        </div>
    </section>

    <section id="cavaliers-list" class="cavaliers-list">
        <div class="container">
            <h2>Liste des Cavaliers</h2>
            <div class="cavaliers-grid">
                <?php
                if (count($cavaliers) > 0) {
                    foreach ($cavaliers as $cavalier) {
                        $age = date_diff(date_create($cavalier['datenacava']), date_create('today'))->y;
                        echo '<div class="cavalier-card reveal">';
                        echo '<div class="cavalier-header">';
                        echo '<i class="fas fa-horse-head"></i>';
                        echo '<h3>' . htmlspecialchars($cavalier['prenomcava']) . ' ' . htmlspecialchars($cavalier['nomcava']) . '</h3>';
                        echo '</div>';
                        echo '<div class="cavalier-info">';
                        echo '<p><strong>Âge :</strong> ' . $age . ' ans</p>';
                        echo '<p><strong>Date de naissance :</strong> ' . htmlspecialchars($cavalier['datenacava']) . '</p>';
                        echo '<p><strong>Licence :</strong> ' . htmlspecialchars($cavalier['numlic']) . '</p>';
                        echo '<p><strong>Galop :</strong> ' . htmlspecialchars($cavalier['idgalop']) . '</p>';
                        echo '<p><strong>Responsable :</strong> ' . htmlspecialchars($cavalier['prenomresp']) . ' ' . htmlspecialchars($cavalier['nomresp']) . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="no-cavaliers">Aucun cavalier trouvé dans la base de données.</p>';
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
            <h2>Rejoignez Notre Équipe</h2>
            <p>Vous êtes passionné par l’équitation ? Que vous soyez novice ou cavalier expérimenté, EquiHorizon vous ouvre ses portes. Inscrivez-vous dès aujourd’hui pour faire partie de notre communauté et vivre des moments inoubliables avec nos chevaux.</p>
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
