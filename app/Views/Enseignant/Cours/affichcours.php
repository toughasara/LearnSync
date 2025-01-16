<?php
    require_once("../../../../vendor/autoload.php");
    use App\Controllers\Enseignant\CourseController;

    $courseController = new courseController();
    $courses = $courseController->getAllCourses();

    if (isset($_GET['delete_id'])) {
        $courseId = $_GET['delete_id'];
        $courseController->deleteCourse($courseId);
        // Rediriger pour éviter la suppression multiple lors du rafraîchissement
        header("Location: affichcours.php");
        exit;
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
    <title>Gestion des Cours - Youdemy</title>
    <link rel="stylesheet" href="../../assests/css/Enseignant/menuens.css">
    <link rel="stylesheet" href="../../assests/css/Enseignant/gererens.css">
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
                    <button class="menu-btn active">
                        <i class="bi bi-collection"></i>
                        Mes Cours
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button class="menu-btn">
                        <i class="bi bi-plus-circle"></i>
                        Ajouter un Cours
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button class="menu-btn">
                        <i class="bi bi-graph-up"></i>
                        Statistiques
                    </button>
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
                            <img src="<?php echo htmlspecialchars($course['image']); ?>" alt="<?php echo htmlspecialchars($course['title']); ?>">
                        </div>
                        <div class="course-content">
                            <h3 class="h5 mb-2"><?php echo htmlspecialchars($course['title']); ?></h3>
                            <p class="text-muted mb-3"><?php echo htmlspecialchars($course['description']); ?></p>
                            <div class="mb-3">
                                <?php foreach($course['tags'] as $tag): ?>
                                    <span class="tag"><?php echo htmlspecialchars($tag); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-event me-2"></i><?php echo htmlspecialchars($course['date']); ?>
                                </small>
                                <div>
                                    <button class="btn btn-outline-primary btn-sm" onclick="modifierCours(<?php echo $course['id']; ?>)">
                                        <i class="bi bi-pencil me-1"></i>Modifier
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm ms-2" onclick="supprimerCours(<?php echo $course['id']; ?>)">
                                        <i class="bi bi-trash me-1"></i>Supprimer
                                    </button>
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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../../assests/js/Enseignant/affichcours.js"></script>
</body>
</html>