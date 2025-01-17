<?php

    session_start();
    if(!isset($_SESSION["id"]) && !isset($_SESSION["role"]) && $_SESSION["role"] != "Administrateur"){
        header("Location: ../auth/login.php");
        exit();
    }

    require_once("../../../../vendor/autoload.php");
    use App\Controllers\Admin\StatistiqueController;

    $statistiqueController = new StatistiqueController();

    $totalCours = $statistiqueController->getTotalCours();
    $totalEtudiants = $statistiqueController->getTotalEtudiants();
    $totalEnseignants = $statistiqueController->getTotalEnseignants();
    $repartitionCategorie = $statistiqueController->getRepartitionParCategorie();
    $coursPlusPopulaire = $statistiqueController->getCoursPlusPopulaire();
    $top3Enseignants = $statistiqueController->getTop3Enseignants();
        
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - CareerLink</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assests/css/admin/dashbord.css">
    <link rel="stylesheet" href="../../assests/css/admin/statistique.css">
</head>
<body>
    <!-- [Sidebar remains unchanged] -->
    <button id="sidebar-toggle" class="btn btn-primary d-lg-none">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="p-3">
        <h3 class="text-white mb-4 px-2">Youdemy</h3>
        <nav class="nav flex-column">
            <a href="../Statistique/affichstatiq.php" class="nav-link active">
                <i class="bi bi-graph-up"></i> Statistiques
            </a>
            <a href="../Utilisateur/affichens.php" class="nav-link">
                <i class="bi bi-briefcase"></i> Utilisateurs
            </a>
            <a href="../Categorie/categories.php" class="nav-link">
                <i class="bi bi-grid"></i> Catégories
            </a>
            <a href="../Tag/tags.php" class="nav-link">
                <i class="bi bi-tags"></i> Tags
            </a>
        </nav>
    </div>
    <!-- Main Content -->
    <div id="content">
        <!-- Header -->
        <div class="header mb-4">
            <h1 class="fw-bold">Statistiques</h1>
            <p>Vue d'ensemble de la plateforme éducative</p>
        </div>

        <!-- Statistics Cards -->
        <div class="container">
            <div class="row g-4">
                <!-- Total Cours -->
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-soft-primary me-3">
                                <i class="bi bi-book"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Total Cours</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalCours ?></h3>
                            </div>
                        </div>
                        <div class="mt-3 text-success">
                            <small><i class="bi bi-arrow-up"></i> +8% ce mois</small>
                        </div>
                    </div>
                </div>

                <!-- Total Étudiants -->
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-soft-success me-3">
                                <i class="bi bi-people"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Total Étudiants</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalEtudiants ?></h3>
                            </div>
                        </div>
                        <div class="mt-3 text-success">
                            <small><i class="bi bi-arrow-up"></i> +15% ce mois</small>
                        </div>
                    </div>
                </div>

                <!-- Enseignants -->
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-soft-warning me-3">
                                <i class="bi bi-person-workspace"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Enseignants</h6>
                                <h3 class="mb-0 fw-bold"><?= $totalEnseignants ?></h3>
                            </div>
                        </div>
                        <div class="mt-3">
                            <small>Actifs ce mois</small>
                        </div>
                    </div>
                </div>

                <!-- Cours le plus populaire -->
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-soft-info me-3">
                                <i class="bi bi-star"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Cours Populaire</h6>
                                <h3 class="mb-0 fw-bold"><?= $coursPlusPopulaire['total_etudiants'] ?? 0 ?> </h3>
                            </div>
                        </div>
                        <div class="mt-3 text-muted">
                            <small><?= $coursPlusPopulaire['title'] ?? 'N/A' ?></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Répartition par catégorie -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="chart-card">
                        <h4>Répartition par Catégorie</h4>
                        <div class="mt-4">
                            <?php foreach ($repartitionCategorie as $categorie): ?>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span><?= $categorie['nom'] ?></span>
                                        <span><?= $categorie['total'] ?> cours</span>
                                    </div>
                                    <div class="progress category-progress">
                                        <div class="progress-bar bg-primary" style="width: <?= ($categorie['total'] / $totalCours) * 100 ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Top 3 Enseignants -->
                <div class="col-md-6">
                    <div class="chart-card">
                        <h4>Top 3 Enseignants</h4>
                        <div class="mt-4">
                            <?php foreach ($top3Enseignants as $index => $enseignant): ?>
                                <div class="top-teacher-card d-flex align-items-center mb-3">
                                    <div class="teacher-rank rank-<?= $index + 1 ?> me-3"><?= $index + 1 ?></div>
                                    <div>
                                        <h5 class="mb-1"><?= $enseignant['nom'] ?></h5>
                                        <p class="mb-0 text-muted"><?= $enseignant['total_etudiants'] ?> étudiants</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="../assests/js/dashbord.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>