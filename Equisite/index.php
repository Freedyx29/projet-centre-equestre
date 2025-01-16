<?php
include_once '../class/class.cavaliers.php';

// Création d'une instance de la classe Cavalier
$cavalier = new Cavaliers();
// Récupération de toutes les cavaliers depuis la base de données
$cavaliersList = $cavalier->CavaliersALL();
// Récupérer le nombre de cavaliers
$cavalierCount = count($cavaliersList);

// Vérifier si la requête est une requête AJAX pour récupérer le nombre de cavaliers
if (isset($_GET['action']) && $_GET['action'] == 'get_cavalier_count') {
    echo json_encode(['cavali erCount' => $cavalierCount]);
    exit;
}

include_once '../class/class.evenements.php';

// Création d'une instance de la classe Evenements
$evenements = new Evenements();
// Récupération des 3 derniers événements depuis la base de données
$evenementsList = $evenements->EvenementsAll();
$evenementsList = array_slice($evenementsList, -3); // Prendre les 3 derniers éléments
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Equihorizon - Centre Équestre</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/2.0.7/countUp.min.js"></script>

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Votre contenu HTML ici -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- AOS JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Initialiser AOS -->
    <script>
        AOS.init();
    </script>

<body>
    <style>
/* Styles pour la section Actualités */
.news {
    padding: 30px 0;
    background-color: #f8f9fa;
    text-align: center; /* Centrer le texte */
}

.news h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 2.5rem; /* Augmenter la taille du titre */
    color: #333;
    font-family: 'Open Sans', sans-serif;
    position: relative;
}

.news h2::after {
    content: '';
    position: absolute;
    width: 80px;
    height: 3px;
    background: #e67e22;
    left: 50%;
    bottom: -15px;
    transform: translateX(-50%);
}

.news-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Centrer les articles */
    gap: 15px;
}

.news-card {
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
    max-width: 350px; /* Augmenter la largeur maximale */
    margin: 10px; /* Ajouter une marge pour espacer les cartes */
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.news-card img {
    width: 100%;
    height: 200px; /* Augmenter la hauteur des images */
    border-bottom: 2px solid #e67e22;
    transition: transform 0.3s;
    object-fit: cover; /* Assurer que l'image couvre toute la zone */
}

.news-card:hover img {
    transform: scale(1.05);
}

.news-content {
    padding: 15px; /* Augmenter le padding interne */
}

.news-content h3 {
    margin-bottom: 15px;
    font-size: 1.5rem; /* Augmenter la taille du titre */
    color: #333;
    font-family: 'Roboto', sans-serif;
    transition: color 0.3s;
}

.news-content h3:hover {
    color: #e67e22;
}

.news-content p {
    margin-bottom: 20px;
    font-size: 1.1rem; /* Augmenter la taille du texte */
    color: #777;
    font-family: 'Open Sans', sans-serif;
}

.news-content .read-more {
    display: inline-flex;
    align-items: center;
    padding: 10px 20px;
    color: #e67e22; /* Changer la couleur du texte en orange */
    border: none; /* Enlever la bordure */
    background-color: transparent; /* Enlever le fond */
    transition: transform 0.3s, color 0.3s;
    position: relative;
    overflow: hidden;
    text-decoration: none; /* Enlever le soulignement du lien */
    font-size: 1rem; /* Augmenter la taille du texte du bouton */
}

.news-content .read-more:hover {
    transform: translateY(-2px);
    color: #d35400; /* Changer la couleur du texte au survol */
}

.news-content .read-more::after {
    content: '\2192'; /* Code Unicode pour la flèche droite */
    margin-left: 8px; /* Espacement entre le texte et la flèche */
    transition: margin-left 0.3s;
    font-size: 1rem; /* Augmenter la taille de l'icône de flèche */
}

.news-content .read-more:hover::after {
    margin-left: 12px; /* Déplacer légèrement la flèche vers la droite au survol */
}

.news-content .badge {
    display: inline-block;
    padding: 5px 10px;
    background-color: #e67e22;
    color: #fff;
    font-size: 0.9rem; /* Augmenter la taille du badge */
    border-radius: 10px;
    margin-bottom: 10px;
}

.news-content .date {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    color: #999;
    font-size: 0.9rem; /* Augmenter la taille du texte de la date */
}

.news-content .date i {
    margin-right: 5px;
}

/* Styles pour le bouton "Voir la suite" */
.btn-primary {
    background-color: #e67e22;
    border-color: #e67e22;
    color: #fff;
    padding: 15px 30px;
    font-size: 1.2rem;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
}

.btn-primary:hover {
    background-color: #d35400;
    transform: translateY(-2px);
}

</style>

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Chargement...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container-fluid">
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Centered logo -->
            <a href="index.php" class="navbar-brand d-flex justify-content-center position-absolute start-50 translate-middle-x" style="top: -10px;"> <!-- Added top property -->
                <img src="../photos/equip.png" alt="Logo" class="m-0" style="height: 100px;">
            </a>

            <!-- Links on the left -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarCollapse">
                <div class="navbar-nav p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link active me-2" style="font-size: 15px !important;">Accueil</a>
                    <a href="propos.php" class="nav-item nav-link me-3" style="font-size: 15px !important; white-space: nowrap;">À propos</a>
                    <a href="cavaliers.php" class="nav-item nav-link me-3" style="font-size: 15px !important;">Cavaliers</a>
                    <a href="evenements.php" class="nav-item nav-link me-3" style="font-size: 15px !important;">Événements</a>
                    <a href="cours.php" class="nav-item nav-link me-3" style="font-size: 15px !important;">Cours</a>
                    <a href="cavalerie.php" class="nav-item nav-link me-3" style="font-size: 15px !important;">Cavalerie</a>
                    <a href="contact.php" class="nav-item nav-link" style="font-size: 15px !important;">Contact</a>
                </div>
            </div>

            <!-- Topbar content on the right -->
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                    <small class="fa fa-phone-alt text-primary me-2"></small>
                    <small>+33 1 23 45 67 89</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-sm-square rounded-circle bg-white text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Appointment button on the right -->
            <a href="vue.utilisateurs.php" class="login-button">
                <i class="fas fa-user"></i> Espace Utilisateur
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="container-fluid header bg-primary p-0 mb-5">
        <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-4 text-white mb-5">Equihorizon</h1>
                <div class="row g-4">
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" id="cavalier-count"><?php echo $cavalierCount; ?></h2>
                            <p class="text-light mb-0">Cavaliers Expérimentés</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">123</h2>
                            <p class="text-light mb-0">Équipements</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">345</h2>
                            <p class="text-light mb-0">Membres</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div id="image-slider" class="owl-carousel owl-theme">
                    <div class="item"><img class="img-fluid" src="../photos/rider.jpg" alt="Image 1"></div>
                    <div class="item"><img class="img-fluid" src="../photos/cap.jpg" alt="Image 2"></div>
                    <div class="item"><img class="img-fluid" src="../photos/ele.jpg" alt="Image 3"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <style>
        body {
            overflow-x: hidden;
            /* Empêche le défilement horizontal */
            margin: 0;
            /* Supprime les marges par défaut du body */
        }

        .container-fluid {
            width: 100%;
            /* Assure que le conteneur prend toute la largeur */
            padding: 0;
            /* Supprime les paddings qui pourraient causer un débordement */
        }

        /* Bouton de connexion */
        .login-button {
            padding: 0.6rem 1.4rem;
            background: var(--secondary-color);
            color: white;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(230, 126, 34, 0.2);
            display: flex;
            align-items: center;
            white-space: nowrap;
            /* Empêche le texte de se diviser en plusieurs lignes */
        }

        .login-button:hover {
            background: var(--secondary-color);
            /* Garder la même couleur de fond */
            color: white;
            /* Garder la même couleur de texte */
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 126, 34, 0.3);
        }

        .login-button i {
            margin-right: 8px;
            /* Ajuster l'espacement entre l'icône et le texte */
        }

        :root {
            --secondary-color: #e67e22;
            /* Exemple de couleur secondaire */
            --accent-color: #d35400;
            /* Exemple de couleur d'accent */
        }

        /* Ajouter une bordure jaune à certains éléments */
        .border-yellow {
            border: 2px solid #f6ae2d !important;
        }

        /* Changer la couleur de fond de certains éléments */
        .bg-yellow {
            background-color: #f6ae2d !important;
        }

        /* Ajouter des effets de survol jaune */
        .hover-yellow:hover {
            background-color: #f6ae2d !important;
            color: white !important;
        }

        /* Ajouter une couleur jaune aux icônes */
        .text-yellow {
            color: #f6ae2d !important;
        }

        /* Ajouter une couleur jaune aux boutons */
        .btn-yellow {
            background-color: #f6ae2d !important;
            border-color: #f6ae2d !important;
        }

        .btn-yellow:hover {
            background-color: #e09f24 !important;
            border-color: #e09f24 !important;
        }

    </style>

    <script>
$(document).ready(function () {
    $("#image-slider").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000, // 2 seconds
        autoplayHoverPause: true
    });

    // Fonction pour mettre à jour le nombre de cavaliers
    function updateCavalierCount() {
        $.ajax({
            url: 'index.php?action=get_cavalier_count',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Mettre à jour le nombre de cavaliers avec animation
                const cavalierCountElement = document.getElementById('cavalier-count');
                const cavalierCount = data.cavalierCount;
                const options = {
                    duration: 2, // Durée de l'animation en secondes
                    useEasing: true, // Utiliser l'accélération
                    useGrouping: true, // Utiliser les séparateurs de milliers
                    separator: ' ', // Séparateur de milliers
                    decimal: '.', // Séparateur décimal
                };
                const countUp = new CountUp(cavalierCountElement, cavalierCount, options);
                countUp.start();

                // Mettre à jour le nombre total de cavaliers sans animation
                $("#total-cavaliers-count").text(cavalierCount);
            },
            error: function (xhr, status, error) {
                console.error("Erreur lors de la récupération du nombre de cavaliers:", error);
            }
        });
    }

    // Mettre à jour le nombre de cavaliers toutes les 5 secondes
    setInterval(updateCavalierCount, 5000);

    // Mettre à jour le nombre de cavaliers au chargement de la page
    updateCavalierCount();

    // Mettre à jour le nombre de cavaliers après chaque modification
    $("form").on("submit", function () {
        setTimeout(updateCavalierCount, 1000); // Attendre 1 seconde après la soumission du formulaire
    });
});

    </script>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex flex-column">
                        <img class="img-fluid rounded w-75 align-self-end" src="../photos/ala.jpg" alt="">
                        <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="../photos/a.jpg" alt="" style="margin-top: -25%;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4">Pourquoi Nous Faire Confiance ? Découvrez-Nous !</h1>
                    <h3>Nos engagements</h3>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Soins de qualité pour les chevaux</p>
                    <p>Nous veillons au bien-être des chevaux grâce à des soins personnalisés, adaptés à leurs besoins physiques et émotionnels. Votre cheval est entre de bonnes mains.</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Cavaliers qualifiés</p>
                    <p>Notre équipe est composée de cavaliers expérimentés et certifiés, capables d’allier technique et sensibilité pour le respect de l’animal.</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Professionnels de la recherche équestre</p>
                    <p>Nous contribuons à l’avancée des connaissances dans le domaine équestre en collaborant avec des experts et en mettant en place des pratiques innovantes.</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="">En savoir plus</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Services</p>
                <h1>Solutions Équestres</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-horse text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Équitation</h4>
                        <p class="mb-4">Découvrez les bases et perfectionnez votre technique à cheval.</p>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#equitationModal"><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-trophy text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Dressage</h4>
                        <p class="mb-4">Apprenez la maîtrise et l'élégance de votre monture.</p>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#dressageModal"><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-horse-head text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Saut d'obstacles</h4>
                        <p class="mb-4">Entraînez-vous au franchissement d'obstacles avec précision.</p>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#sautObstaclesModal"><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-child text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Cours pour enfants</h4>
                        <p class="mb-4">Des cours adaptés pour éveiller les jeunes cavaliers.</p>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#coursEnfantsModal"><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-users text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Cours pour adultes</h4>
                        <p class="mb-4">Apprenez ou progressez dans une ambiance conviviale.</p>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#coursAdultesModal"><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-horse text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Pension pour chevaux</h4>
                        <p class="mb-4">Offrez un cadre sécurisé et confortable à votre cheval.</p>
                        <a class="btn" href="" data-bs-toggle="modal" data-bs-target="#pensionChevauxModal"><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

<!-- Section Actualités -->
<section class="news">
    <h2>Nos Actualités</h2>
    <div class="news-grid">
        <?php foreach ($evenementsList as $e): ?>
            <article class="news-card" data-aos="fade-up">
                <?php
                $photos = $evenements->getPhotosByIdeve($e['ideve']);
                if (!empty($photos)):
                    if (count($photos) > 1): ?>
                        <div id="carousel-<?php echo $e['ideve']; ?>" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($photos as $index => $photo):
                                    $photoPath = '../uploads/' . basename($photo['lienphoto']);
                                    if (file_exists($photoPath)): ?>
                                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                            <img src="<?php echo $photoPath; ?>" alt="<?php echo $e['titre']; ?>" class="d-block w-100">
                                        </div>
                                    <?php endif;
                                endforeach; ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php echo $e['ideve']; ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php echo $e['ideve']; ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    <?php else:
                        $photoPath = '../uploads/' . basename($photos[0]['lienphoto']);
                        if (file_exists($photoPath)): ?>
                            <img src="<?php echo $photoPath; ?>" alt="<?php echo $e['titre']; ?>" class="img-fluid">
                        <?php else: ?>
                            <span>Photo introuvable : <?php echo basename($photos[0]['lienphoto']); ?></span>
                        <?php endif;
                    endif;
                else: ?>
                    <img src="../photos/default.jpg" alt="Default Image" class="img-fluid">
                <?php endif; ?>
                <div class="news-content">
                    <span class="badge">Nouveau</span>
                    <div class="date">
                        <i class="fas fa-calendar-alt"></i>
                        <span>15 Juin 2024</span>
                    </div>
                    <h3><?php echo htmlspecialchars($e['titre']); ?></h3>
                    <p><?php echo htmlspecialchars($e['commentaire']); ?></p>
                    <a href="evenements.php" class="read-more">Lire la suite</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <div class="text-center mt-4">
        <a href="evenements.php" class="btn btn-primary">Voir la suite</a>
    </div>
</section>

    <!-- Modals -->
    <div class="modal fade" id="equitationModal" tabindex="-1" aria-labelledby="equitationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="equitationModalLabel">Équitation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mb-3" src="../photos/1.jpg" alt="Équitation">
                    <p>Découvrez les bases et perfectionnez votre technique à cheval. Nos cours d'équitation sont adaptés à tous les niveaux, des débutants aux cavaliers expérimentés. Apprenez à monter en toute sécurité et à développer une relation harmonieuse avec votre cheval.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dressageModal" tabindex="-1" aria-labelledby="dressageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dressageModalLabel">Dressage</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mb-3" src="../photos/2.jpg" alt="Dressage">
                    <p>Apprenez la maîtrise et l'élégance de votre monture. Nos cours de dressage sont conçus pour vous aider à développer une relation harmonieuse avec votre cheval, en mettant l'accent sur la précision et la finesse des mouvements.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sautObstaclesModal" tabindex="-1" aria-labelledby="sautObstaclesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sautObstaclesModalLabel">Saut d'obstacles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mb-3" src="../photos/3.jpg" alt="Saut d'obstacles">
                    <p>Entraînez-vous au franchissement d'obstacles avec précision. Nos cours de saut d'obstacles sont conçus pour vous aider à développer vos compétences et à améliorer votre technique de saut.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="coursEnfantsModal" tabindex="-1" aria-labelledby="coursEnfantsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="coursEnfantsModalLabel">Cours pour enfants</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mb-3" src="../photos/4.jpg" alt="Cours pour enfants">
                    <p>Des cours adaptés pour éveiller les jeunes cavaliers. Nos cours pour enfants sont conçus pour initier les jeunes à l'équitation de manière ludique et sécurisée.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="coursAdultesModal" tabindex="-1" aria-labelledby="coursAdultesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="coursAdultesModalLabel">Cours pour adultes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mb-3" src="../photos/5.jpg" alt="Cours pour adultes">
                    <p>Apprenez ou progressez dans une ambiance conviviale. Nos cours pour adultes sont conçus pour vous aider à développer vos compétences équestres, quel que soit votre niveau.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="pensionChevauxModal" tabindex="-1" aria-labelledby="pensionChevauxModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pensionChevauxModalLabel">Pension pour chevaux</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid mb-3" src="../photos/6.jpg" alt="Pension pour chevaux">
                    <p>Offrez un cadre sécurisé et confortable à votre cheval. Notre pension pour chevaux est conçue pour offrir à votre cheval un environnement sûr et agréable, avec des soins personnalisés.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
<style>
/* CSS pour les cases des cavaliers */
.team-card {
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    overflow: hidden;
    margin-bottom: 20px;
    position: relative;
    padding: 20px;
    text-align: center;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.team-content h5 {
    margin-bottom: 10px;
    font-size: 1.5rem;
    color: #333;
    font-family: 'Roboto', sans-serif;
    transition: color 0.3s;
}

.team-content h5:hover {
    color: #e67e22;
}

.team-content p {
    margin-bottom: 15px;
    font-size: 1rem;
    color: #777;
    font-family: 'Open Sans', sans-serif;
}

.team-content .badge {
    display: inline-block;
    padding: 5px 10px;
    background-color: #e67e22;
    color: #fff;
    font-size: 0.8rem;
    border-radius: 10px;
    margin-bottom: 10px;
}

.team-content .date {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    color: #999;
    font-size: 0.8rem;
}

.team-content .date i {
    margin-right: 5px;
}

/* Animations CSS pour les titres */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.team-content h5 {
    animation: fadeInUp 1s ease-out;
}
</style>

    <!-- Feature Start -->
    <div class="container-fluid bg-primary overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="p-lg-5 ps-lg-0">
                        <p class="d-inline-block border rounded-pill text-light py-1 px-4">Caractéristiques</p>
                        <h1 class="text-white mb-4">Pourquoi Nous Choisir</h1>
                        <p class="text-white mb-4 pb-2">Chez Equihorizon, nous mettons tout en œuvre pour offrir à nos cavaliers et à leurs chevaux une expérience unique et enrichissante.</p>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                        <i class="fa fa-user-md text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Expérience</p>
                                        <h5 class="text-white mb-0">Cavaliers</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                        <i class="fa fa-check text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Qualité</p>
                                        <h5 class="text-white mb-0">Services</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                        <i class="fa fa-comment-medical text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Positive</p>
                                        <h5 class="text-white mb-0">Consultation</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light" style="width: 55px; height: 55px;">
                                        <i class="fa fa-headphones text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">24 Heures</p>
                                        <h5 class="text-white mb-0">Support</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="../photos/1.jpg" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Cavaliers</p>
            <h1>Nos Cavaliers Expérimentés</h1>
            <p id="total-cavaliers">Total de cavaliers: <span id="total-cavaliers-count"><?php echo $cavalierCount; ?></span></p>
        </div>
        <div class="owl-carousel team-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($cavaliersList as $cavalier): ?>
                <div class="team-card">
                    <div class="team-content">
                        <h5><?php echo htmlspecialchars($cavalier['nomcava']); ?></h5>
                        <p class="text-primary"><?php echo htmlspecialchars($cavalier['prenomcava']); ?></p>
                        <?php if (isset($cavalier['lib_galop'])): ?>
                            <p class="text-secondary"><?php echo htmlspecialchars($cavalier['lib_galop']); ?></p>
                        <?php else: ?>
                            <p class="text-secondary">N/A</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="cavaliers.php" class="btn btn-primary py-2 px-4">Voir tout</a>
        </div>
    </div>
</div>
<!-- Team End -->



    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Réservation</p>
                    <h1 class="mb-4">Réservez une Séance avec Nos Cavaliers</h1>
                    <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Appelez-Nous Maintenant</p>
                            <h5 class="mb-0">+33 1 23 45 67 89</h5>
                        </div>
                    </div>
                    <div class="bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope-open text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Écrivez-Nous Maintenant</p>
                            <h5 class="mb-0">equi@horizon.fr</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                        <form>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Votre Nom" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control border-0" placeholder="Votre Email" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Votre Téléphone" style="height: 55px;">
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control border-0 datetimepicker-input"
                                            placeholder="Choisir une Date" data-target="#date" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-0" rows="5" placeholder="Décrivez votre problème"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Réserver une Séance</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Témoignages</p>
                <h1>Ce que Disent Nos Clients !</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-1.jpg" style="width: 100px; height: 100px;" alt="Claire Leroy">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>Equihorizon a transformé ma relation avec mon cheval. Les cours sont excellents et les cavaliers sont très professionnels.</p>
                        <h5 class="mb-1">Claire Leroy</h5>
                        <span class="fst-italic">Cavalière Amateur</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-2.jpg" style="width: 100px; height: 100px;" alt="Paul Dupuis">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>Je recommande vivement Equihorizon pour la qualité de ses services et l'attention portée à chaque cavalier.</p>
                        <h5 class="mb-1">Paul Dupuis</h5>
                        <span class="fst-italic">Cavalier Professionnel</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-3.jpg" style="width: 100px; height: 100px;" alt="Julie Martin">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>Les installations sont superbes et les chevaux sont très bien soignés. Une expérience inoubliable !</p>
                        <h5 class="mb-1">Julie Martin</h5>
                        <span class="fst-italic">Étudiante en Équitation</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Adresse</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Rue, Paris, France</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+33 1 23 45 67 890</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>equi@herizon.fr</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Services</h5>
                <p><i class="fas fa-horse me-3"></i>Équitation</p>
                <p><i class="fas fa-horse-head me-3"></i>Dressage</p>
                <p><i class="fas fa-horse me-3"></i>Saut d'obstacles</p>
                <p><i class="fas fa-child me-3"></i>Cours pour enfants</p>
                <p><i class="fas fa-user me-3"></i>Cours pour adultes</p>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4">Newsletter</h5>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Votre email">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">S'inscrire</button>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <img src="../photos/equi.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright text-center">
            <div class="row">
                <div class="col-12">
                    &copy; Equihorizon, Tous Droits Réservés.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
   <script>
$(document).ready(function () {
    // Initialiser le carrousel des cavaliers
    $(".team-carousel").owlCarousel({
        items: 4,
        loop: true,
        margin: 30,
        autoplay: true,
        autoplayTimeout: 1000, // 1 seconde
        autoplayHoverPause: true,
        smartSpeed: 500, // Vitesse de transition en millisecondes
        nav: true,
        navText: ["<span class='carousel-control-prev-icon' aria-hidden='true'></span>", "<span class='carousel-control-next-icon' aria-hidden='true'></span>"],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });

    // Fonction pour mettre à jour le nombre de cavaliers
    function updateCavalierCount() {
        $.ajax({
            url: 'index.php?action=get_cavalier_count',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Mettre à jour le nombre de cavaliers avec animation
                const cavalierCountElement = document.getElementById('cavalier-count');
                const cavalierCount = data.cavalierCount;
                const options = {
                    duration: 2, // Durée de l'animation en secondes
                    useEasing: true, // Utiliser l'accélération
                    useGrouping: true, // Utiliser les séparateurs de milliers
                    separator: ' ', // Séparateur de milliers
                    decimal: '.', // Séparateur décimal
                };
                const countUp = new CountUp(cavalierCountElement, cavalierCount, options);
                countUp.start();

                // Mettre à jour le nombre total de cavaliers sans animation
                $("#total-cavaliers-count").text(cavalierCount);
            },
            error: function (xhr, status, error) {
                console.error("Erreur lors de la récupération du nombre de cavaliers:", error);
            }
        });
    }

    // Mettre à jour le nombre de cavaliers toutes les 5 secondes
    setInterval(updateCavalierCount, 5000);

    // Mettre à jour le nombre de cavaliers au chargement de la page
    updateCavalierCount();

    // Mettre à jour le nombre de cavaliers après chaque modification
    $("form").on("submit", function () {
        setTimeout(updateCavalierCount, 1000); // Attendre 1 seconde après la soumission du formulaire
    });
});
</script>

</body>

</html>

