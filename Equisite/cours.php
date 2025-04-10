<?php
require_once '../include/bdd.inc.php';

// Connexion à la base de données
$pdo = connexionPDO();

// Récupérer les filtres
$searchNom = isset($_GET['search_nom']) ? trim($_GET['search_nom']) : '';
$searchJour = isset($_GET['jour']) ? trim($_GET['jour']) : '';

// Construire la requête SQL pour les cours avec les filtres
$sql = "SELECT c.*, 
        (SELECT COUNT(*) FROM inscrit i WHERE i.refidcours = c.idcours AND i.supprime = 0) as nb_inscrits 
        FROM cours c 
        WHERE c.supprime = 0";
$params = [];

if ($searchNom !== '') {
    $sql .= " AND c.libcours LIKE :search_nom";
    $params[':search_nom'] = '%' . $searchNom . '%';
}

if ($searchJour !== '' && $searchJour !== 'Tous') {
    $sql .= " AND c.jour = :jour";
    $params[':jour'] = $searchJour;
}

$sql .= " ORDER BY c.jour, c.hdebut";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cours = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les cavaliers inscrits pour chaque cours
$coursAvecInscrits = [];
foreach ($cours as $c) {
    $stmtInscrits = $pdo->prepare("
        SELECT ca.nomcava, ca.prenomcava 
        FROM inscrit i 
        JOIN cavaliers ca ON i.refidcava = ca.idcava 
        WHERE i.refidcours = :idcours AND i.supprime = 0
    ");
    $stmtInscrits->execute([':idcours' => $c['idcours']]);
    $inscrits = $stmtInscrits->fetchAll(PDO::FETCH_ASSOC);
    $c['inscrits'] = $inscrits;
    $coursAvecInscrits[] = $c;
}

// Liste des jours pour le filtre
$jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours - Centre Équestre EquiHorizon</title>
    <link rel="stylesheet" href="../Equisite/css/cours.css">
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
            <h1>Nos Cours</h1>
            <p>Participez à nos cours d’équitation adaptés à tous les niveaux</p>
            <a href="#cours-list" class="btn-hero">Découvrir</a>
        </div>
    </section>

    <section class="intro">
        <div class="container">
            <h2>Planning des Cours</h2>
            <p>Consultez notre planning hebdomadaire et trouvez le cours qui vous convient. Utilisez les filtres pour affiner votre recherche et voir les détails de chaque cours, y compris les participants inscrits.</p>
        </div>
    </section>

    <section id="cours-list" class="cours-list">
        <div class="container">
            <h2>Liste des Cours</h2>

            <!-- Filtres -->
            <div class="filters">
                <div class="filter-container">
                    <div class="filter-group">
                        <label for="search_nom">Rechercher par nom :</label>
                        <input type="text" id="search_nom" value="<?= htmlspecialchars($searchNom) ?>" placeholder="Nom du cours" class="filter-input">
                    </div>
                    <div class="filter-group">
                        <label for="filter_jour">Filtrer par jour :</label>
                        <select id="filter_jour" class="filter-select">
                            <option value="Tous" <?= $searchJour === 'Tous' || $searchJour === '' ? 'selected' : '' ?>>Tous les jours</option>
                            <?php foreach ($jours as $jour): ?>
                                <option value="<?= $jour ?>" <?= $searchJour === $jour ? 'selected' : '' ?>><?= $jour ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tableau des cours -->
            <div class="cours-table">
                <table>
                    <thead>
                        <tr>
                            <th>Nom du Cours</th>
                            <th>Jour</th>
                            <th>Heure de Début</th>
                            <th>Heure de Fin</th>
                            <th>Inscrits</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="cours-tbody">
                        <?php if (count($coursAvecInscrits) > 0): ?>
                            <?php foreach ($coursAvecInscrits as $c): ?>
                                <tr class="reveal">
                                    <td><?= htmlspecialchars($c['libcours']) ?></td>
                                    <td><?= htmlspecialchars($c['jour']) ?></td>
                                    <td><?= htmlspecialchars($c['hdebut']) ?></td>
                                    <td><?= htmlspecialchars($c['hfin']) ?></td>
                                    <td><?= $c['nb_inscrits'] ?> cavalier(s)</td>
                                    <td>
                                        <button class="btn-details" 
                                                data-nom="<?= htmlspecialchars($c['libcours']) ?>" 
                                                data-jour="<?= htmlspecialchars($c['jour']) ?>" 
                                                data-hdebut="<?= htmlspecialchars($c['hdebut']) ?>" 
                                                data-hfin="<?= htmlspecialchars($c['hfin']) ?>" 
                                                data-inscrits='<?= json_encode($c['inscrits']) ?>'>Détails</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr id="no-cours">
                                <td colspan="6" class="no-cours">Aucun cours trouvé.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modale pour les détails -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Détails du Cours</h2>
            <div id="modal-details">
                <p><strong>Nom :</strong> <span id="modal-nom"></span></p>
                <p><strong>Jour :</strong> <span id="modal-jour"></span></p>
                <p><strong>Heure de début :</strong> <span id="modal-hdebut"></span></p>
                <p><strong>Heure de fin :</strong> <span id="modal-hfin"></span></p>
                <h3>Cavaliers Inscrits</h3>
                <ul id="modal-inscrits"></ul>
            </div>
        </div>
    </div>

    <section class="join-us">
        <div class="container">
            <h2>Rejoignez Nos Cours</h2>
            <p>Que vous soyez débutant ou cavalier confirmé, nos cours sont conçus pour vous faire progresser tout en vous amusant. Inscrivez-vous dès maintenant !</p>
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
        // Animation au défilement (comme dans ton original)
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

        // Gestion simplifiée des filtres et de la modale
        const searchNom = document.getElementById('search_nom');
        const filterJour = document.getElementById('filter_jour');
        const rows = document.querySelectorAll('.reveal');
        const noCours = document.getElementById('no-cours');
        const modal = document.getElementById('modal');
        const closeModal = document.querySelector('.close');

        // Filtrage sans rechargement
        function filterCourses() {
            const nomValue = searchNom.value.trim().toLowerCase();
            const jourValue = filterJour.value === 'Tous' ? '' : filterJour.value;
            let hasVisibleRows = false;

            rows.forEach(row => {
                const nom = row.cells[0].textContent.toLowerCase();
                const jour = row.cells[1].textContent;

                if (nom.includes(nomValue) && (!jourValue || jour === jourValue)) {
                    row.style.display = '';
                    hasVisibleRows = true;
                } else {
                    row.style.display = 'none';
                }
            });

            if (noCours) noCours.style.display = hasVisibleRows ? 'none' : '';
        }

        searchNom.addEventListener('input', filterCourses);
        filterJour.addEventListener('change', filterCourses);

        // Gestion de la modale (exactement comme dans ton original)
        document.querySelectorAll('.btn-details').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('modal-nom').textContent = button.getAttribute('data-nom');
                document.getElementById('modal-jour').textContent = button.getAttribute('data-jour');
                document.getElementById('modal-hdebut').textContent = button.getAttribute('data-hdebut');
                document.getElementById('modal-hfin').textContent = button.getAttribute('data-hfin');

                const inscrits = JSON.parse(button.getAttribute('data-inscrits'));
                const modalInscrits = document.getElementById('modal-inscrits');
                modalInscrits.innerHTML = '';
                if (inscrits.length > 0) {
                    inscrits.forEach(cavalier => {
                        const li = document.createElement('li');
                        li.textContent = cavalier.nomcava + ' ' + cavalier.prenomcava; // Erreur ici dans ton original
                        modalInscrits.appendChild(li);
                    });
                } else {
                    const li = document.createElement('li');
                    li.textContent = 'Aucun cavalier inscrit.';
                    modalInscrits.appendChild(li);
                }

                modal.style.display = 'block';
            });
        });

        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Filtrer au chargement
        filterCourses();
    </script>
</body>
</html>
