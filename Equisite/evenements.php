<!DOCTYPE html>
<html lang="en">

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
                    <a href="cavaliers.php" class="nav-item nav-link me-3" style="font-size: 15px !important;">Cavaliers</a>
                    <a href="evenements.php" class="nav-item nav-link active me-3" style="font-size: 15px !important;">Événements</a>
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

    <style>

    </style>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s" style="background-image: url('../photos/bubbles.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; position: relative;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
        <div class="container py-5" style="position: relative; z-index: 2;">
            <h1 class="display-3 text-white mb-3 animated slideInDown text-start">Évènement</h1>
            <nav aria-label="breadcrumb animated slideInDown">
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Section Actualités -->
    <section class="news py-5">
        <div class="container">
            <h2 class="text-center mb-4">Nos Actualités</h2>
            <div class="news-grid row">
                <article class="news-card col-md-4 mb-4" data-aos="fade-up">
                    <img src="../photos/1.jpg" alt="Stage d'été" class="img-fluid">
                    <div class="news-content p-3">
                        <span class="badge bg-primary">Nouveau</span>
                        <div class="date mb-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>15 Juin 2024</span>
                        </div>
                        <h3>Stages d'été 2024</h3>
                        <p>Découvrez notre programme complet de stages pour cet été. Du débutant au confirmé, il y en a pour tous les niveaux !</p>
                    </div>
                </article>

                <article class="news-card col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <img src="../photos/1.jpg" alt="Compétition" class="img-fluid">
                    <div class="news-content p-3">
                        <span class="badge bg-primary">Événement</span>
                        <div class="date mb-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>15 Juin 2024</span>
                        </div>
                        <h3>Concours CSO - 15 Juin</h3>
                        <p>Participez à notre prochain concours de saut d'obstacles. Épreuves Club et Amateur au programme.</p>
                    </div>
                </article>

                <article class="news-card col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <img src="../photos/1.jpg" alt="Nouveau pensionnaire" class="img-fluid">
                    <div class="news-content p-3">
                        <span class="badge bg-primary">Nouveauté</span>
                        <div class="date mb-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>15 Juin 2024</span>
                        </div>
                        <h3>Nouveau Pensionnaire</h3>
                        <p>Découvrez notre nouvelle recrue : Éclair, un magnifique Pure-sang Espagnol qui rejoint notre cavalerie.</p>
                    </div>
                </article>

                <article class="news-card col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <img src="../photos/1.jpg" alt="Journée portes ouvertes" class="img-fluid">
                    <div class="news-content p-3">
                        <span class="badge bg-primary">Événement</span>
                        <div class="date mb-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>20 Juin 2024</span>
                        </div>
                        <h3>Journée Portes Ouvertes</h3>
                        <p>Venez découvrir notre centre équestre lors de notre journée portes ouvertes. Démonstrations et activités pour tous !</p>
                    </div>
                </article>

                <article class="news-card col-md-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <img src="../photos/1.jpg" alt="Atelier de dressage" class="img-fluid">
                    <div class="news-content p-3">
                        <span class="badge bg-primary">Atelier</span>
                        <div class="date mb-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>25 Juin 2024</span>
                        </div>
                        <h3>Atelier de Dressage</h3>
                        <p>Participez à notre atelier de dressage pour améliorer vos compétences équestres. Ouvert à tous les niveaux.</p>
                    </div>
                </article>

                <article class="news-card col-md-4 mb-4" data-aos="fade-up" data-aos-delay="500">
                    <img src="../photos/1.jpg" alt="Randonnée équestre" class="img-fluid">
                    <div class="news-content p-3">
                        <span class="badge bg-primary">Événement</span>
                        <div class="date mb-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>30 Juin 2024</span>
                        </div>
                        <h3>Randonnée Équestre</h3>
                        <p>Rejoignez-nous pour une randonnée équestre à travers les magnifiques paysages de la région.</p>
                    </div>
                </article>
            </div>

        </div>
    </section>
    <!-- Section Actualités End -->

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
