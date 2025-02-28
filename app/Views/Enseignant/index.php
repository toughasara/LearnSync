<?php
    session_start();
    require_once("../../../vendor/autoload.php");
    use App\Controllers\Enseignant\CourseController;
    use App\Controllers\Auth\AuthController;
    
    if (isset($_POST['logout'])) {
        $authController = new AuthController();
        $authController->logOut();
    }

    if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "enseignant" ||  $_SESSION["status"] !== "active") {
        header("Location: ../../Auth/login.php");
        exit();
    }

    $utilisateurId = $_SESSION["id"];

    $courseController = new courseController();
    $courses = $courseController->getAllCoursesutil($utilisateurId);

    if (isset($_GET['delete_id'])) {
        $courseId = $_GET['delete_id'];
        $courseController->deleteCourse($courseId);
        $courses = $courseController->getAllCoursesutil($utilisateurId);
    }

    $items_per_page = 6;
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $total_items = count($courses);
    $total_pages = ceil($total_items / $items_per_page);
    $offset = ($current_page - 1) * $items_per_page;

    $current_courses = array_slice($courses, $offset, $items_per_page);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours - Youdemy</title>
    <link rel="stylesheet" href="../assests/css/Enseignant/menuens.css">
    <link rel="stylesheet" href="../assests/css/Enseignant/gererens.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="dashboard-header text-center">
        <div class="container">
            <h1>Gestion des Cours</h1>
            <p>Gérez et publiez vos cours avec facilité</p>
        </div>
    </div>
    <div class="container">
        <div class="menu-buttons">
            <div class="row g-3">
            <div class="col-12 col-md-4">
                <a href="../index.php" class="menu-btn active">
                    <i class="bi bi-collection"></i>
                    Mes Cours
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="Cours/ajoutercours.php" class="menu-btn">
                    <i class="bi bi-plus-circle"></i>
                    Ajouter un Cours
                </a>
            </div>
            <div class="col-12 col-md-4">
                <a href="Cours/statistiques.php" class="menu-btn">
                    <i class="bi bi-graph-up"></i>
                    Statistiques
                </a>
            </div>
        </div>
    </div>

        <!-- Barre de recherche et filtres -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Rechercher un cours..." id="recherche-cours">
                </div>
            </div>
            <div class="col-md-4">
                <select class="form-select" id="filtre-categorie">
                    <option value="">Toutes les catégories</option>
                    <option value="dev">Développement</option>
                    <option value="design">Design</option>
                    <option value="marketing">Marketing</option>
                </select>
            </div>
        </div>

        <!-- Grille des cours -->
        <div class="row" id="courses-container">
            <?php foreach($current_courses as $course): ?>
                <div class="col-md-4">
                    <div class="course-card">
                        <div class="course-image">
                            <img src="../assests/images/imgCourse.png" alt="<?php echo htmlspecialchars($course->getTitle()); ?>">
                        </div>
                        <div class="course-content">
                            <h3 class="h5 mb-2"><?php echo htmlspecialchars($course->getTitle()); ?></h3>
                            <p class="text-muted mb-3"><?php echo htmlspecialchars($course->getDescription()); ?></p>
                            <div class="mb-3">
                                <span class="tag"><?php echo htmlspecialchars($course->getCategorie()->getNom()); ?></span>
                                <?php foreach($course->getTags() as $tag): ?>
                                    <span class="tag"><?php echo htmlspecialchars($tag->getNom()); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-event me-2"></i><?php echo htmlspecialchars($course->getCreatedAt()); ?>
                                </small>
                                <div>
                                    <a href="Cours/updatecours.php?update_id=<?php echo $course->getId(); ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil me-1"></i>Modifier
                                    </a>
                                    <a href="index.php?delete_id=<?php echo $course->getId(); ?>" class="btn btn-outline-danger btn-sm ms-2">
                                        <i class="bi bi-trash me-1"></i>Supprimer
                                    </a>
                                    <a href="Cours/inscription.php?course_id=<?php echo $course->getId(); ?>" class="btn btn-outline-success btn-sm ms-2">
                                        <i class="bi bi-person-plus me-1"></i>Inscription
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <nav aria-label="Navigation des pages">
            <ul class="pagination">
                <li class="page-item <?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page - 1; ?>" <?php echo ($current_page <= 1) ? 'tabindex="-1" aria-disabled="true"' : ''; ?>>Précédent</a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($current_page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Suivant</a>
                </li>
            </ul>
        </nav>
        <!-- Bouton de déconnexion -->
        <form method="POST" class="d-inline">
                <button type="submit" name="logout" class="btn btn-primary me-2">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>