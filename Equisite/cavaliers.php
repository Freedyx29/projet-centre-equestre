<?php
include_once '../class/class.cavaliers.php';

// Création d'une instance de la classe Cavalier
$cavalier = new Cavaliers();
// Récupération de toutes les cavaliers depuis la base de données
$cavaliersList = $cavalier->CavaliersAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Equihorizon - Nos Cavaliers</title>
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden; /* Empêche le défilement horizontal */
            margin: 0; /* Supprime les marges par défaut du body */
        }
        .container-fluid {
            width: 100%; /* Assure que le conteneur prend toute la largeur */
            padding: 0; /* Supprime les paddings qui pourraient causer un débordement */
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
            white-space: nowrap; /* Empêche le texte de se diviser en plusieurs lignes */
        }

        .login-button:hover {
            background: var(--secondary-color); /* Garder la même couleur de fond */
            color: white; /* Garder la même couleur de texte */
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 126, 34, 0.3);
        }

        .login-button i {
            margin-right: 8px; /* Ajuster l'espacement entre l'icône et le texte */
        }

        :root {
            --secondary-color: #e67e22; /* Exemple de couleur secondaire */
            --accent-color: #d35400; /* Exemple de couleur d'accent */
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

        /* Style pour les cartes des cavaliers */
        .team-item {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .team-item:hover {
            transform: translateY(-10px);
        }

        .team-text {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .team-text h5 {
            margin-bottom: 10px;
        }

        .team-text p {
            margin: 5px 0;
        }

        /* Style pour les icônes */
        .team-icon {
            font-size: 2rem;
            color: var(--secondary-color);
            margin-bottom: 10px;
        }

        /* Style pour l'image de fond de la section header */
        .page-header {
            background: url('../photos/1.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            text-align: center;
            padding: 100px 0;
        }

        .page-header h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .page-header p {
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
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
                    <a href="index.php" class="nav-item nav-link me-2" style="font-size: 15px !important;">Accueil</a>
                    <a href="propos.php" class="nav-item nav-link me-3" style="font-size: 15px !important; white-space: nowrap;">À propos</a>
                    <a href="cavaliers.php" class="nav-item nav-link active me-3" style="font-size: 15px !important;">Cavaliers</a>
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

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: url('../photos/1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
    <div class="container py-5" style="position: relative; z-index: 2;">
        <h1 class="display-3 text-white mb-3 animated slideInDown text-start">Cavaliers</h1>
        <nav aria-label="breadcrumb animated slideInDown">
        </nav>
    </div>
</div>
<!-- Page Header End -->



    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Cavaliers</p>
                <h1>Nos Cavaliers Expérimentés</h1>
                <p id="total-cavaliers">Total de cavaliers: <span id="cavalier-count"><?php echo count($cavaliersList); ?></span></p>
            </div>
            <div class="row g-4">
                <?php foreach ($cavaliersList as $cavalier): ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item position-relative rounded overflow-hidden">
                            <div class="team-text bg-light text-center p-4">
                                <i class="fas fa-horse team-icon"></i>
                                <h5><?php echo htmlspecialchars($cavalier['nomcava']); ?></h5>
                                <p class="text-primary"><?php echo htmlspecialchars($cavalier['prenomcava']); ?></p>
                                <p class="text-secondary"><?php echo htmlspecialchars($cavalier['libgalop']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Team End -->

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
</body>

</html>
