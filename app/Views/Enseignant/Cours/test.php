<?php


    require_once("../../../../vendor/autoload.php");
    use App\Controllers\courseController;

    $courseController = new courseController();

    $courses = $courseController->getcourses();


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
        <div class="row" id="courses-container"></div>
        
        <!-- Pagination -->
        <nav aria-label="Navigation des pages">
            <ul class="pagination" id="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Exemple de données de cours (à remplacer par vos données PHP)
        const courses = [
            {
                id: 1,
                title: "Introduction au Développement Web",
                description: "Apprenez les bases du développement web avec HTML, CSS et JavaScript.",
                image: "/api/placeholder/400/200",
                date: "15/01/2024",
                tags: ["HTML", "CSS", "JavaScript"]
            },
            {
                id: 1,
                title: "Introduction au Développement Web",
                description: "Apprenez les bases du développement web avec HTML, CSS et JavaScript.",
                image: "/api/placeholder/400/200",
                date: "15/01/2024",
                tags: ["HTML", "CSS", "JavaScript"]
            },
            {
                id: 1,
                title: "Introduction au Développement Web",
                description: "Apprenez les bases du développement web avec HTML, CSS et JavaScript.",
                image: "/api/placeholder/400/200",
                date: "15/01/2024",
                tags: ["HTML", "CSS", "JavaScript"]
            },
            {
                id: 1,
                title: "Introduction au Développement Web",
                description: "Apprenez les bases du développement web avec HTML, CSS et JavaScript.",
                image: "/api/placeholder/400/200",
                date: "15/01/2024",
                tags: ["HTML", "CSS", "JavaScript"]
            },
            {
                id: 1,
                title: "Introduction au Développement Web",
                description: "Apprenez les bases du développement web avec HTML, CSS et JavaScript.",
                image: "/api/placeholder/400/200",
                date: "15/01/2024",
                tags: ["HTML", "CSS", "JavaScript"]
            },
            {
                id: 1,
                title: "Introduction au Développement Web",
                description: "Apprenez les bases du développement web avec HTML, CSS et JavaScript.",
                image: "/api/placeholder/400/200",
                date: "15/01/2024",
                tags: ["HTML", "CSS", "JavaScript"]
            },
            {
                id: 1,
                title: "Introduction au Développement Web",
                description: "Apprenez les bases du développement web avec HTML, CSS et JavaScript.",
                image: "/api/placeholder/400/200",
                date: "15/01/2024",
                tags: ["HTML", "CSS", "JavaScript"]
            },
            {
                id: 1,
                title: "Introduction au Développement Web",
                description: "Apprenez les bases du développement web avec HTML, CSS et JavaScript.",
                image: "/api/placeholder/400/200",
                date: "15/01/2024",
                tags: ["HTML", "CSS", "JavaScript"]
            },
            // Ajoutez d'autres cours ici
        ];

        // Configuration de la pagination
        const ITEMS_PER_PAGE = 6;
        let currentPage = 1;

        // Fonction pour créer une carte de cours
        function createCourseCard(course) {
            return `
                <div class="col-md-4">
                    <div class="course-card">
                        <div class="course-image">
                            <img src="${course.image}" alt="${course.title}">
                        </div>
                        <div class="course-content">
                            <h3 class="h5 mb-2">${course.title}</h3>
                            <p class="text-muted mb-3">${course.description}</p>
                            <div class="mb-3">
                                ${course.tags.map(tag => `<span class="tag">${tag}</span>`).join('')}
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted"><i class="bi bi-calendar-event me-2"></i>${course.date}</small>
                                <div>
                                    <button class="btn btn-outline-primary btn-sm" onclick="modifierCours(${course.id})">
                                        <i class="bi bi-pencil me-1"></i>Modifier
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm ms-2" onclick="supprimerCours(${course.id})">
                                        <i class="bi bi-trash me-1"></i>Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Fonction pour afficher les cours de la page courante
        function displayCourses(page) {
            const coursesContainer = document.getElementById('courses-container');
            const start = (page - 1) * ITEMS_PER_PAGE;
            const end = start + ITEMS_PER_PAGE;
            const coursesToDisplay = courses.slice(start, end);

            coursesContainer.innerHTML = coursesToDisplay.map(course => createCourseCard(course)).join('');
            updatePagination();
        }

        // Fonction pour mettre à jour la pagination
        function updatePagination() {
            const totalPages = Math.ceil(courses.length / ITEMS_PER_PAGE);
            const pagination = document.getElementById('pagination');
            let paginationHTML = '';

            // Bouton précédent
            paginationHTML += `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage - 1})" tabindex="-1">Précédent</a>
                </li>
            `;

            // Pages numérotées
            for (let i = 1; i <= totalPages; i++) {
                paginationHTML += `
                    <li class="page-item ${currentPage === i ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                    </li>
                `;
            }

            // Bouton suivant
            paginationHTML += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage + 1})">Suivant</a>
                </li>
            `;

            pagination.innerHTML = paginationHTML;
        }

        // Fonction pour changer de page
        function changePage(page) {
            if (page < 1 || page > Math.ceil(courses.length / ITEMS_PER_PAGE)) return;
            currentPage = page;
            displayCourses(currentPage);
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

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

        // Initialisation de l'affichage
        document.addEventListener('DOMContentLoaded', function() {
            displayCourses(currentPage);
            
            // Votre code existant pour les boutons de menu et la recherche reste ici
        });
    </script>
    <!-- <script>
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
                console.log('Recherche:', this.value);
            });

            // Gestion des filtres
            const filtreCategorie = document.getElementById('filtre-categorie');
            filtreCategorie.addEventListener('change', function() {
                console.log('Filtre:', this.value);
            });
        });
    </script> -->
</body>
</html>