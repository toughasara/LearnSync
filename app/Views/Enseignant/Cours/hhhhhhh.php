<?php
    require_once("../../../../vendor/autoload.php");
    use App\Controllers\courseController;

    $courseController = new courseController();
    $courses = $courseController->getcourses();

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
    <style>
        /* Votre CSS existant reste identique */
        :root {
            --primary-color: #2C3E50;
            --secondary-color: #3498DB;
            --accent-color: #E74C3C;
            --light-gray: #F8F9FA;
        }

        body {
            background-color: var(--light-gray);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .menu-buttons {
            background-color: white;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .menu-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            background-color: var(--light-gray);
            color: var(--primary-color);
            border: none;
            width: 100%;
        }

        .menu-btn:hover, .menu-btn.active {
            background-color: var(--secondary-color);
            color: white;
        }

        .course-card {
            background-color: white;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
            height: 100%;
        }

        .course-card:hover {
            transform: translateY(-2px);
        }

        .course-image {
            height: 200px;
            overflow: hidden;
            border-radius: 8px 8px 0 0;
        }

        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .course-content {
            padding: 1.5rem;
        }

        .tag {
            background-color: var(--light-gray);
            color: var(--primary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            display: inline-block;
        }

        .pagination {
            justify-content: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .page-link {
            color: var(--primary-color);
            border-color: var(--secondary-color);
        }

        .page-item.active .page-link {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .menu-buttons .row > div {
                margin-bottom: 1rem;
            }
        }
    </style>
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
    <script>
        // Fonctions pour modifier et supprimer les cours
        function modifierCours(id) {
            console.log('Modifier cours:', id);
            // Ajoutez votre logique de modification
        }

        function supprimerCours(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')) {
                console.log('Supprimer cours:', id);
                // Ajoutez votre logique de suppression
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Gestion des boutons de menu
            const menuButtons = document.querySelectorAll('.menu-btn');
            
            menuButtons.forEach(button => {
                button.addEventListener('click', function() {
                    menuButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Gestion de la recherche
            const rechercheInput = document.getElementById('recherche-cours');
            rechercheInput.addEventListener('input', function() {
                // Ajoutez la logique de recherche en PHP
                window.location.href = '?search=' + encodeURIComponent(this.value);
            });

            // Gestion des filtres
            const filtreCategorie = document.getElementById('filtre-categorie');
            filtreCategorie.addEventListener('change', function() {
                // Ajoutez la logique de filtrage en PHP
                window.location.href = '?category=' + encodeURIComponent(this.value);
            });
        });
    </script>
</body>
</html>