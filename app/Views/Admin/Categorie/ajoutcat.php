<?php
    session_start();

    require_once("../../../../vendor/autoload.php");
    use App\Controllers\Admin\CategorieController;

    $categorieController = new CategorieController();
    
    if(isset($_POST["submit"]))
    {
        if(empty($_POST["name"]) && empty($_POST["description"]))
        {
            echo "name or description is empty";
        }
        else{
            $noms = $_POST["name"];
            $description = $_POST["description"];

            $categorieController->addcategorie($noms, $description);

            header("Location: categories.php");
            exit;
        }
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
            <a href="../index.php" class="nav-link">
                <i class="bi bi-graph-up"></i> Statistiques
            </a>
            <a href="../Utilisateur/affichens.php" class="nav-link">
                <i class="bi bi-briefcase"></i> Utilisateurs
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
                    <form id="addCategoryForm" action="" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom de la catégorie</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                        </div>
                        <input hidden type="password" class="form-control" name="submit" value="submit">
                        <div class="modal-footer">
                            <a type="submit" href="categories.html" class="btn btn-secondary">Annuler</a>
                            <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>