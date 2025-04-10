<?php
require_once '../include/bdd.inc.php';
?>

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
                <li><a href="index.php">Accueil</a></li>
                <li><a href="propos.php">À propos</a></li>
                <li><a href="cavaliers.php">Cavaliers</a></li>
                <li><a href="cavalerie.php">Cavalerie</a></li>
                <li><a href="cours.php">Cours</a></li>
                <li><a href="evenements.php">Evenements</a></li>
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
            <h1>Bienvenue sur notre site</h1>
            <p>Découvrez nos services et installations</p>
            <a href="evenements.php" class="btn-auth"><i class="fas fa-calendar-alt"></i> Événements</a>
        </div>
    </section>

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
            <h2 class="section-title">Nos Cours</h2>

            <!-- Filtres de recherche -->
            <form id="course-filters" class="course-filters">
                <div class="filter-group">
                    <label for="filter-galop">Galop:</label>
                    <input type="text" id="filter-galop" name="galop" value="<?php echo isset($_GET['galop']) ? htmlspecialchars($_GET['galop']) : ''; ?>" placeholder="Nom du cours">
                </div>
                <div class="filter-group">
                    <label for="filter-hour">Heure:</label>
                    <input type="time" id="filter-hour" name="hour" value="<?php echo isset($_GET['hour']) ? htmlspecialchars($_GET['hour']) : ''; ?>">
                </div>
                <div class="filter-group">
                    <label for="filter-day">Jour:</label>
                    <select id="filter-day" name="day">
                        <option value="">Tous</option>
                        <option value="Lundi" <?php echo isset($_GET['day']) && $_GET['day'] === 'Lundi' ? 'selected' : ''; ?>>Lundi</option>
                        <option value="Mardi" <?php echo isset($_GET['day']) && $_GET['day'] === 'Mardi' ? 'selected' : ''; ?>>Mardi</option>
                        <option value="Mercredi" <?php echo isset($_GET['day']) && $_GET['day'] === 'Mercredi' ? 'selected' : ''; ?>>Mercredi</option>
                        <option value="Jeudi" <?php echo isset($_GET['day']) && $_GET['day'] === 'Jeudi' ? 'selected' : ''; ?>>Jeudi</option>
                        <option value="Vendredi" <?php echo isset($_GET['day']) && $_GET['day'] === 'Vendredi' ? 'selected' : ''; ?>>Vendredi</option>
                        <option value="Samedi" <?php echo isset($_GET['day']) && $_GET['day'] === 'Samedi' ? 'selected' : ''; ?>>Samedi</option>
                    </select>
                </div>

            </form>

            <!-- Liste des cours -->
            <div class="courses-grid" id="courses-grid">
                <?php
                $pdo = connexionPDO();
                $itemsPerPage = 8; // Changé de 8 à 5
                $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
                $offset = ($currentPage - 1) * $itemsPerPage;

                $query = "SELECT * FROM cours WHERE supprime = 0";
                $params = [];

                if (!empty($_GET['galop'])) {
                    $query .= " AND libcours LIKE :galop";
                    $params[':galop'] = '%' . $_GET['galop'] . '%';
                }
                if (!empty($_GET['hour'])) {
                    $query .= " AND hdebut LIKE :hour";
                    $params[':hour'] = $_GET['hour'] . '%';
                }
                if (!empty($_GET['day'])) {
                    $query .= " AND jour = :day";
                    $params[':day'] = $_GET['day'];
                }

                $countStmt = $pdo->prepare("SELECT COUNT(*) FROM cours WHERE supprime = 0" .
                    (empty($_GET['galop']) ? '' : " AND libcours LIKE :galop") .
                    (empty($_GET['hour']) ? '' : " AND hdebut LIKE :hour") .
                    (empty($_GET['day']) ? '' : " AND jour = :day"));
                $countStmt->execute($params);
                $totalItems = $countStmt->fetchColumn();
                $totalPages = ceil($totalItems / $itemsPerPage);

                $query .= " LIMIT :offset, :limit";
                $stmt = $pdo->prepare($query);
                foreach ($params as $key => $value) {
                    $stmt->bindValue($key, $value);
                }
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
                $stmt->execute();
                $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($courses as $course) {
                    echo '<div class="course-item reveal">';
                    echo '<h3>' . htmlspecialchars($course['libcours']) . '</h3>';
                    echo '<p>' . htmlspecialchars($course['jour']) . ': ' .
                        substr($course['hdebut'], 0, 8) . ' - ' .
                        substr($course['hfin'], 0, 8) . '</p>';
                    echo '</div>';
                }
                ?>
            </div>

            <!-- Pagination -->
            <div class="pagination" id="pagination">
                <?php
                $baseUrl = 'index.php?';
                $queryParams = array_filter([
                    'galop' => $_GET['galop'] ?? '',
                    'hour' => $_GET['hour'] ?? '',
                    'day' => $_GET['day'] ?? ''
                ]);
                $baseUrl .= http_build_query($queryParams) . '&page=';

                if ($currentPage > 1) {
                    echo '<a href="' . $baseUrl . ($currentPage - 1) . '#equipe" class="page-btn prev">Précédent</a>';
                } else {
                    echo '<button class="page-btn prev" disabled>Précédent</button>';
                }

                echo '<span class="page-info">Page ' . $currentPage . ' sur ' . $totalPages . '</span>';

                if ($currentPage < $totalPages) {
                    echo '<a href="' . $baseUrl . ($currentPage + 1) . '#equipe" class="page-btn next">Suivant</a>';
                } else {
                    echo '<button class="page-btn next" disabled>Suivant</button>';
                }
                ?>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const filtersForm = document.getElementById('course-filters');
            const coursesGrid = document.getElementById('courses-grid');
            const pagination = document.getElementById('pagination');
            let currentPage = <?php echo $currentPage; ?>;

            function fetchCourses(page = 1) {
                const formData = new FormData(filtersForm);
                formData.append('page', page);

                fetch('fetch_courses.php?' + new URLSearchParams(formData), {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Mettre à jour la grille des cours
                        coursesGrid.innerHTML = '';
                        data.courses.forEach(course => {
                            const div = document.createElement('div');
                            div.className = 'course-item reveal';
                            div.innerHTML = `
                    <h3>${course.libcours}</h3>
                    <p>${course.jour}: ${course.hdebut.slice(0, 5)} - ${course.hfin.slice(0, 5)}</p>
                `;
                            coursesGrid.appendChild(div);
                        });

                        // Mettre à jour la pagination
                        pagination.innerHTML = `
                <button class="page-btn prev" ${data.currentPage === 1 ? 'disabled' : ''}>Précédent</button>
                <span class="page-info">Page ${data.currentPage} sur ${data.totalPages}</span>
                <button class="page-btn next" ${data.currentPage === data.totalPages ? 'disabled' : ''}>Suivant</button>
            `;

                        currentPage = data.currentPage;

                        // Ajouter les événements aux boutons de pagination
                        pagination.querySelector('.prev').addEventListener('click', () => {
                            if (currentPage > 1) fetchCourses(currentPage - 1);
                        });
                        pagination.querySelector('.next').addEventListener('click', () => {
                            if (currentPage < data.totalPages) fetchCourses(currentPage + 1);
                        });

                        // Réactiver les animations
                        setTimeout(() => {
                            document.querySelectorAll('.reveal').forEach(item => item.classList.add('active'));
                        }, 100);
                    })
                    .catch(error => console.error('Erreur:', error));
            }

            // Événement sur le formulaire
            filtersForm.addEventListener('submit', (e) => {
                e.preventDefault();
                fetchCourses(1);
            });

            // Événements en temps réel sur les filtres
            document.getElementById('filter-galop').addEventListener('input', () => fetchCourses(1));
            document.getElementById('filter-hour').addEventListener('change', () => fetchCourses(1));
            document.getElementById('filter-day').addEventListener('change', () => fetchCourses(1));

            // Gestion des boutons de pagination initiaux
            pagination.querySelectorAll('.page-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (!btn.disabled) {
                        const isNext = btn.classList.contains('next');
                        fetchCourses(currentPage + (isNext ? 1 : -1));
                    }
                });
            });
        });
    </script>

    <section id="contact" class="contact">
        <h2>Contactez-nous</h2>
        <div class="contact-container">
            <div class="contact-info">
                <h3>Informations</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Route des Écuries, 19100 Brive-la-Gaillarde</p>
                <p><i class="fas fa-phone"></i> 01 23 45 67 89</p>
                <p><i class="fas fa-envelope"></i> contact@equihorizon.fr</p>
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
