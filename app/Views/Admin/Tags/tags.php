<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags - CareerLink</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assests/css/admin/dashbord.css">
    <link rel="stylesheet" href="../../assests/css/admin/tags.css">
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="p-3">
        <h3 class="text-white mb-4 px-2">CareerLink</h3>
        <nav class="nav flex-column">
            <a href="../statistique.php" class="nav-link">
                <i class="bi bi-graph-up"></i> Statistiques
            </a>
            <a href="../offremploie.php" class="nav-link">
                <i class="bi bi-briefcase"></i> Offres d'emploi
            </a>
            <a href="../Categorie/categories.php" class="nav-link">
                <i class="bi bi-grid"></i> Catégories
            </a>
            <a href="../Tag/tags.php" class="nav-link active">
                <i class="bi bi-tags"></i> Tags
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div id="content">
        <!-- Header -->
        <div class="header mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold mb-0">Tags</h1>
                    <p class="mb-0">Gérez les tags des offres d'emploi</p>
                </div>
            </div>
        </div>

        <!-- Tags List -->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Liste des tags</h2>
                        <a href="update.html" class="add-btn">
                            <i class="bi bi-plus-lg me-2"></i> Ajouter un tag
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Nombre d'offres</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PHP</td>
                                    <td>28</td>
                                    <td>
                                        <a href="update.html" class="action-btn edit-btn me-2" title="Modifier"><i class="bi bi-pencil"></i></a>
                                        <a href="update.html" class="action-btn delete-btn" title="Supprimer"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>JavaScript</td>
                                    <td>35</td>
                                    <td>
                                        <a href="update.html" class="action-btn edit-btn me-2" title="Modifier"><i class="bi bi-pencil"></i></a>
                                        <a href="update.html" class="action-btn delete-btn" title="Supprimer"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Marketing Digital</td>
                                    <td>20</td>
                                    <td>
                                        <a href="update.html" class="action-btn edit-btn me-2" title="Modifier"><i class="bi bi-pencil"></i></a>
                                        <a href="update.html" class="action-btn delete-btn" title="Supprimer"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="../assests/js/dashbord.js"></script>
    <script src="../assests/js/tags.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>