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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
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
<a href="index.html" class="navbar-brand d-flex justify-content-center position-absolute start-50 translate-middle-x" style="top: -10px;"> <!-- Added top property -->
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
<a href="../vue/vue.utilisateurs.php" class="login-button">
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
                        <h2 class="text-white mb-1" data-toggle="counter-up">4</h2>
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

</style>

<script>
    $(document).ready(function(){
        $("#image-slider").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 2000, // 2 seconds
            autoplayHoverPause: true
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
                        <a class="btn" href=""><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-trophy text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Dressage</h4>
                        <p class="mb-4">Apprenez la maîtrise et l'élégance de votre monture.</p>
                        <a class="btn" href=""><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                        <i class="fa fa-horse-head text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Saut d'obstacles</h4>
                        <p class="mb-4">Entraînez-vous au franchissement d'obstacles avec précision.</p>
                        <a class="btn" href=""><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-child text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Cours pour enfants</h4>
                        <p class="mb-4">Des cours adaptés pour éveiller les jeunes cavaliers.</p>
                        <a class="btn" href=""><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-users text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Cours pour adultes</h4>
                        <p class="mb-4">Apprenez ou progressez dans une ambiance conviviale.</p>
                        <a class="btn" href=""><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4" style="width: 65px; height: 65px;">
                            <i class="fa fa-horse text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Pension pour chevaux</h4>
                        <p class="mb-4">Offrez un cadre sécurisé et confortable à votre cheval.</p>
                        <a class="btn" href=""><i class="fa fa-plus text-primary me-3"></i>En savoir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

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
                        <img class="position-absolute img-fluid w-100 h-100" src="img/feature.jpg" style="object-fit: cover;" alt="">
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
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-1.jpg" alt="Marie Dupont">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Marie Dupont</h5>
                            <p class="text-primary">Instructrice en Équitation</p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-2.jpg" alt="Jean Martin">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Jean Martin</h5>
                            <p class="text-primary">Spécialiste en Dressage</p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-3.jpg" alt="Sophie Lefèvre">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Sophie Lefèvre</h5>
                            <p class="text-primary">Experte en Saut d'Obstacles</p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/team-4.jpg" alt="Pierre Durand">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>Pierre Durand</h5>
                            <p class="text-primary">Entraîneur de Cours pour Enfants</p>
                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
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
                            <h5 class="mb-0">info@example.com</h5>
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
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Services</h5>
                    <a class="btn btn-link" href="">Équitation</a>
                    <a class="btn btn-link" href="">Dressage</a>
                    <a class="btn btn-link" href="">Saut d'obstacles</a>
                    <a class="btn btn-link" href="">Cours pour enfants</a>
                    <a class="btn btn-link" href="">Cours pour adultes</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Liens Rapides</h5>
                    <a class="btn btn-link" href="">À propos de nous</a>
                    <a class="btn btn-link" href="">Contactez-nous</a>
                    <a class="btn btn-link" href="">Nos Services</a>
                    <a class="btn btn-link" href="">Conditions Générales</a>
                    <a class="btn btn-link" href="">Support</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Votre email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">S'inscrire</button>
                    </div>
                </div>
            </div>
        </div>
<div class="container">
    <div class="copyright text-center">
        <div class="row">
            <div class="col-12">
                &copy; <a class="border-bottom" href="#">Equihorizon</a>, Tous Droits Réservés.
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
