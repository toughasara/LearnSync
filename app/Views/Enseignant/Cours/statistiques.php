<?php

    session_start();
    if(!isset($_SESSION["id"]) || $_SESSION["role"] != "enseignant"){
        header("Location: ../auth/login.php");
        exit();
    }

    require_once("../../../../vendor/autoload.php");
    use App\Controllers\Enseignant\StatistiqueController;

    $utilisateurId = $_SESSION["id"];
    $statistiqueController = new StatistiqueController();

    $totalInscriptions = $statistiqueController->getTotalInscriptions($utilisateurId);
    $totalCours = $statistiqueController->getTotalCours($utilisateurId);
    $inscriptionsParCours = $statistiqueController->getInscriptionsParCours($utilisateurId);
        
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Youdemy</title>
    <link rel="stylesheet" href="../../assests/css/Enseignant/menuens.css">
    <link rel="stylesheet" href="../../assests/css/Enseignant/statistiques.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="dashboard-header text-center">
        <div class="container">
            <h1>Statistiques</h1>
            <p>Consultez les statistiques de votre plateforme</p>
        </div>
    </div>

    <div class="container">
        <div class="menu-buttons">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <!-- Bouton "Mes Cours" -->
                    <a href="../index.php" class="menu-btn">
                        <i class="bi bi-collection"></i>
                        Mes Cours
                    </a>
                </div>
                <div class="col-12 col-md-4">
                    <!-- Bouton "Ajouter un Cours" -->
                    <a href="ajoutercours.php" class="menu-btn">
                        <i class="bi bi-plus-circle"></i>
                        Ajouter un Cours
                    </a>
                </div>
                <div class="col-12 col-md-4">
                    <!-- Bouton "Statistiques" -->
                    <a href="statistiques.php" class="menu-btn active">
                        <i class="bi bi-graph-up"></i>
                        Statistiques
                    </a>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-md-6">
                <div class="stat-card">
                    <h3>Nombre d'étudiants inscrits</h3>
                    <p><?php echo $totalInscriptions; ?></p>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="stat-card">
                    <h3>Nombre de cours</h3>
                    <p><?php echo $totalCours; ?></p>
                </div>
            </div>
        </div>

        <div class="course-list">
            <h3>Inscriptions par cours</h3>
            <?php if (!empty($inscriptionsParCours)): ?>
                <?php foreach ($inscriptionsParCours as $cours): ?>
                    <div class="course-item">
                        <span class="course-name"><?php echo htmlspecialchars($cours['course_title']); ?></span>
                        <span class="course-enrollments"><?php echo htmlspecialchars($cours['nombre_inscriptions']); ?> inscriptions</span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-info">Aucun cours trouvé.</div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>