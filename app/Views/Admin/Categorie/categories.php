<?php


    require_once("../../../../vendor/autoload.php");
    use App\Controllers\CategorieController;

    $categorieController = new CategorieController();

    $categories = $categorieController->getCategories();

    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];
        $categorieController->deleteCategoryById($category_id);
        $categories = $categorieController->getCategories();
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories - Youdemy</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assests/css/admin/dashbord.css">
    <link rel="stylesheet" href="../../assests/css/admin/categories.css">
</head>
<body>
    <!-- Sidebar Toggle Button for Mobile -->
    <button id="sidebar-toggle" class="btn btn-primary d-lg-none">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <div id="sidebar" class="p-3">
        <h3 class="text-white mb-4 px-2">Youdemy</h3>
        <nav class="nav flex-column">
            <a href="../statistique.php" class="nav-link">
                <i class="bi bi-graph-up"></i> Statistiques
            </a>
            <a href="../offremploie.php" class="nav-link">
                <i class="bi bi-briefcase"></i> Offres d'emploi
            </a>
            <a href="../Categorie/categories.php" class="nav-link active">
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
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold mb-0">Catégories</h1>
                    <p class="mb-0">Gérez les catégories des cours</p>
                </div>
            </div>
        </div>

        <!-- Categories List -->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Liste des catégories</h2>
                        <a href="ajoutcat.php" class="add-btn">
                            <i class="bi bi-plus-lg me-2"></i> Ajouter une catégorie
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($categories): ?>
                                    <?php foreach ($categories as $category): ?>
                                        <tr>
                                        <input type="hidden" name="id" value="<?= $category->getId() ?>">
                                            <?php echo '<td>' . $category->getNom(). '</td>' ?>
                                            <?php echo '<td>' . $category->getDescription(). '</td>' ?>
                                            <td>
                                                <a href="updatecat.php?id=<?php echo $category->getId(); ?>" class="action-btn edit-btn me-2" title="Modifier"><i class="bi bi-pencil"></i></a>
                                                <a href="categories.php?id=<?php echo $category->getId(); ?>" class="action-btn delete-btn" title="Supprimer"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <!-- <script src="../../assests/js/dashbord.js"></script> -->
    <!-- <script src="../assests/js/catrgories.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>