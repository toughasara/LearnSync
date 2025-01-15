<?php
    session_start();
    require_once("../../../../vendor/autoload.php");
    use App\Controllers\CategorieController;
    
    $categorieController = new CategorieController();


    if (isset($_GET['id'])) {
        $category_id = $_GET['id'];
        $categorie = $categorieController->trouvercategorie($category_id);
    }
    if(isset($_POST["submit"])){

        $nom = $_POST["name"];
        $description = $_POST["description"];
        $categorieController->updateCategorie($category_id, $nom , $description);
        header("Location: categories.php");
        exit;
        
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

        
    <!-- Add Category Modal -->
    <div id="addCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter une catégorie</h5>
                </div>
                <div class="modal-body">
                    <?php if ($categorie): ?>
                            <form id="addCategoryForm" action="" method="POST">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Nom de la catégorie</label>
                                    <input value="<?php echo $categorie->getNom(); ?>" type="text" name="name" class="form-control" id="categoryName" required>
                                    <input hidden value="submit" type="password" class="form-control" name="submit">
                                </div>
                                <div class="mb-3">
                                    <label for="categoryDescription" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" id="categoryDescription" rows="3"><?php echo $categorie->getDescription(); ?></textarea>
                                </div>
                                <div class="modal-footer">
                                    <a href="categories.php" class="btn btn-secondary">Annuler</a>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <!-- <script src="../assests/js/dashbord.js"></script> -->
    <!-- <script src="../assests/js/catrgories.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>