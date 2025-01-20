<?php

    session_start();
    if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "etudiant") {
        header("Location: ../../auth/login.php");
        exit();
    }

    require_once("../../../vendor/autoload.php");
    use App\Controllers\Enseignant\CourseController;
    use App\Controllers\Enseignant\InscriptionController;

    $inscriptionController = new InscriptionController();
    $courseController = new courseController();

    $courses = $courseController->getAllCourses();
    
    // Récupérer le terme de recherche
    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';

    // Récupérer tous les cours ou filtrer par recherche
    if (!empty($searchTerm)) {
        $courses = $courseController->searchCourses($searchTerm);
    } else {
        $courses = $courseController->getAllCourses();
    }

    // Gérer l'inscription
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['course_id'])) {
        $courseId = $_POST['course_id'];
        $utilisateurId = $_SESSION["id"];

        if (!$inscriptionController->estInscrit($courseId, $utilisateurId)) {
            if($inscriptionController->inscrireEtudiant($courseId, $utilisateurId)){
                echo "<script>alert('Vous etes inscrie au course avec succee.');</script>";
            }
        } else {
            echo "<script>alert('Vous etes deja inscrie au course.');</script>";
        }
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
    <title>Cours Disponibles - Youdemy</title>
    <link rel="stylesheet" href="../assests/css/Enseignant/menuens.css">
    <link rel="stylesheet" href="../assests/css/Enseignant/gererens.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="dashboard-header text-center">
        <div class="container">
            <h1>Cours Disponibles</h1>
            <p>Découvrez notre catalogue de cours et inscrivez-vous</p>
        </div>
    </div>
    <div class="container">
        <div class="menu-buttons">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <a href="index.php" class="menu-btn active">
                        <i class="bi bi-collection"></i>
                        Cours Disponibles
                    </a>
                </div>
                <div class="col-12 col-md-6">
                    <a href="mescours.php" class="menu-btn">
                        <i class="bi bi-journal-check"></i>
                        Mes Cours
                    </a>
                </div>
            </div>
        </div>

        <!-- Barre de recherche et filtres -->
        <div class="row mb-4">
            <div class="col-md-8">
                <form action="" method="GET" class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Rechercher un cours..." name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                </form>
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
                            <img src="https://via.placeholder.com/300x200" alt="<?php echo htmlspecialchars($course->getTitle()); ?>">
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
                                <div class="teacher-info">
                                    <small class="text-muted">
                                        <i class="bi bi-person me-1"></i>
                                        <?php echo htmlspecialchars($course->getCreatedAt()); ?>
                                    </small>
                                </div>
                                <div>
                                    <a href="detailscours.php?course_id=<?php echo $course->getId(); ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-info-circle me-1"></i>Détails
                                    </a>
                                    <form action="" method="POST" style="display: inline;">
                                        <input type="hidden" name="course_id" value="<?php echo $course->getId(); ?>">
                                        <button type="submit" class="btn btn-success btn-sm ms-2">
                                            <i class="bi bi-person-plus me-1"></i>S'inscrire
                                        </button>
                                    </form>
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
                    <a class="page-link" href="?page=<?php echo $current_page - 1; ?>&search=<?php echo urlencode($searchTerm); ?>" <?php echo ($current_page <= 1) ? 'tabindex="-1" aria-disabled="true"' : ''; ?>>Précédent</a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo ($current_page == $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo urlencode($searchTerm); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo ($current_page >= $total_pages) ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page + 1; ?>&search=<?php echo urlencode($searchTerm); ?>">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../assests/js/Etudiant/coursdisponibles.js"></script>
</body>
</html>