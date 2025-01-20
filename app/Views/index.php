<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerLink - Votre portail d'emploi</title>
    <link rel="stylesheet" href="assests/css/Visiteur/pagehome.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-briefcase me-2"></i>CareerLink
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Offres</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Entreprises</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-2" href="auth/registrecon.php">Connexion</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Trouvez l'emploi de vos rêves</h1>
                    <p class="lead mb-4">Des milliers d'opportunités professionnelles vous attendent. Commencez votre recherche maintenant !</p>
                </div>
                <div class="col-lg-6">
                    <div class="search-box">
                        <form id="searchForm">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control" placeholder="Titre, entreprise ou mots-clés">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select">
                                        <option>Toutes les catégories</option>
                                        <option>Développement</option>
                                        <option>Design</option>
                                        <option>Marketing</option>
                                        <option>Finance</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Localisation">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Rechercher <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">5000+</div>
                        <div class="stat-label">Offres d'emploi</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">2000+</div>
                        <div class="stat-label">Entreprises</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">10K+</div>
                        <div class="stat-label">Candidats</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">3000+</div>
                        <div class="stat-label">Recrutements</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Jobs Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Dernières offres d'emploi</h2>
            <div class="row">
                <!-- Job Card 1 -->
                <div class="col-md-4">
                    <div class="job-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" alt="Company logo" class="company-logo">
                            <span class="badge bg-light text-primary">CDI</span>
                        </div>
                        <h5>Développeur Full Stack</h5>
                        <p class="text-muted mb-3">TechCorp</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Paris</span>
                            <span class="text-primary fw-bold">45K-55K €</span>
                        </div>
                    </div>
                </div>

                <!-- Job Card 2 -->
                <div class="col-md-4">
                    <div class="job-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" alt="Company logo" class="company-logo">
                            <span class="badge bg-light text-primary">CDD</span>
                        </div>
                        <h5>UX Designer</h5>
                        <p class="text-muted mb-3">DesignStudio</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Lyon</span>
                            <span class="text-primary fw-bold">35K-45K €</span>
                        </div>
                    </div>
                </div>

                <!-- Job Card 3 -->
                <div class="col-md-4">
                    <div class="job-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <img src="https://via.placeholder.com/50" alt="Company logo" class="company-logo">
                            <span class="badge bg-light text-primary">Freelance</span>
                        </div>
                        <h5>Chef de Projet Marketing</h5>
                        <p class="text-muted mb-3">MarketPro</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Bordeaux</span>
                            <span class="text-primary fw-bold">400€/j</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="#" class="btn btn-primary">Voir toutes les offres</a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Catégories populaires</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="category-card">
                        <i class="fas fa-laptop-code category-icon"></i>
                        <h5>Développement</h5>
                        <p class="text-muted">450 offres</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-card">
                        <i class="fas fa-paint-brush category-icon"></i>
                        <h5>Design</h5>
                        <p class="text-muted">280 offres</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-card">
                        <i class="fas fa-chart-line category-icon"></i>
                        <h5>Marketing</h5>
                        <p class="text-muted">320 offres</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-card">
                        <i class="fas fa-coins category-icon"></i>
                        <h5>Finance</h5>
                        <p class="text-muted">190 offres</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h3 class="mb-4">Restez informé des nouvelles opportunités</h3>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Votre adresse email">
                            <button class="btn btn-primary">
                                S'abonner <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">À propos de CareerLink</h5>
                    <p class="text-light">Votre plateforme de confiance pour trouver les meilleures opportunités professionnelles et faire progresser votre carrière.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <h5 class="mb-3">Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Accueil</a></li>
                        <li><a href="#" class="text-light">Offres d'emploi</a></li>
                        <li><a href="#" class="text-light">Entreprises</a>
                        <li><a href="#" class="text-light">Blog</a></li>
                        <li><a href="#" class="text-light">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Catégories</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Développement</a></li>
                        <li><a href="#" class="text-light">Design</a></li>
                        <li><a href="#" class="text-light">Marketing</a></li>
                        <li><a href="#" class="text-light">Finance</a></li>
                        <li><a href="#" class="text-light">Ressources Humaines</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Rue Example, 75000 Paris</li>
                        <li><i class="fas fa-phone me-2"></i> +33 1 23 45 67 89</li>
                        <li><i class="fas fa-envelope me-2"></i> contact@careerlink.fr</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-4 bg-light">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2024 CareerLink. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-light me-3">Conditions d'utilisation</a>
                    <a href="#" class="text-light">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- js -->
    <script src="assests/js/pagehome.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>