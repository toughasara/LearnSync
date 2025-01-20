<?php
session_start();
require_once("../../../vendor/autoload.php");
use App\Controllers\Enseignant\CourseController;

$courseController = new CourseController();

// le terme de recherche
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

// tous les cours ou filtrer par recherche
if (!empty($searchTerm)) {
    $courses = $courseController->searchCourses($searchTerm);
} else {
    $courses = $courseController->getAllCourses();
}

// Configuration de la pagination
$items_per_page = 6;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$total_items = count($courses);
$total_pages = ceil($total_items / $items_per_page);
$offset = ($current_page - 1) * $items_per_page;

// Extraire les cours pour la page courante
$current_courses = array_slice($courses, $offset, $items_per_page);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours disponibles - Youdemy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assests/css/Visiteur/catalogue.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-graduation-cap me-2"></i>Youdemy
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="catalogue.php">Cours</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="../index.php">
                            <i class="fas fa-home me-1"></i>Accueil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="../auth/login.php">Connexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container" style="margin-top: 100px;">
        <!-- Search Bar -->
        <div class="search-box">
            <form action="" method="GET">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Rechercher un cours..." name="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </div>
            </form>
        </div>

        <!-- Course List -->
        <h2 class="mb-4">Cours disponibles</h2>
        <div class="row">
            <?php if (!empty($current_courses)): ?>
                <?php foreach ($current_courses as $course): ?>
                    <div class="col-md-4">
                        <div class="course-card">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <img src="https://via.placeholder.com/50" alt="Instructor avatar" class="instructor-avatar">
                                <span class="badge bg-light text-primary"><?php echo htmlspecialchars($course->getCategorie()->getNom()); ?></span>
                            </div>
                            <h5><?php echo htmlspecialchars($course->getTitle()); ?></h5>
                            <p class="text-muted mb-3"><?php echo htmlspecialchars($course->getUtilisateur()->getNom()); ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted"><i class="fas fa-clock me-1"></i><?php echo htmlspecialchars($course->getCreatedAt()); ?></span>
                                <span class="text-primary fw-bold"><?php echo htmlspecialchars($course->getContentType()); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">Aucun cours trouvé.</div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>&search=<?php echo urlencode($searchTerm); ?>" tabindex="-1" aria-disabled="true">Précédent</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($currentPage == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo ($currentPage >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>&search=<?php echo urlencode($searchTerm); ?>">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2024 Youdemy. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-light me-3">Conditions d'utilisation</a>
                    <a href="#" class="text-light">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>