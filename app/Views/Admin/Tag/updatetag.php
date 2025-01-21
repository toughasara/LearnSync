<?php
    session_start();
    require_once("../../../../vendor/autoload.php");
    use App\Controllers\Admin\TagController;
    
    $tagController = new TagController();


    if (isset($_GET['id'])) {
        $tag_id = $_GET['id'];
        $tag = $tagController->trouvertag($tag_id);
    }
    if(isset($_POST["submit"])){

        $nom = $_POST["name"];

        $tagController->updatetag($tag_id, $nom);
        header("Location: tags.php");
        exit;
        
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tags - Youdemy</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assests/css/admin/dashbord.css">
    <link rel="stylesheet" href="../../assests/css/admin/tags.css">
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="p-3">
        <h3 class="text-white mb-4 px-2">Youdemy</h3>
        <nav class="nav flex-column">
            <a href="../Statistique/affichstatiq.php" class="nav-link">
                <i class="bi bi-graph-up"></i> Statistiques
            </a>
            <a href="../Utilisateur/affichens.php" class="nav-link">
                <i class="bi bi-briefcase"></i> Utilisateurs
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
                    <p class="mb-0">Gérez les tags des cours</p>
                </div>
            </div>
        </div>


    <!-- Add Tag Modal -->
    <div id="addTagModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajouter un tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <?php if ($tag): ?>
                            <form id="addCategoryForm" action="" method="POST">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Nom de la catégorie</label>
                                    <input value="<?php echo $tag->getNom(); ?>" type="text" name="name" class="form-control" id="categoryName" required>
                                    <input hidden value="submit" type="password" class="form-control" name="submit">
                                </div>
                                <div class="modal-footer">
                                    <a href="tags.php" class="btn btn-secondary">Annuler</a>
                                    <button type="submit" class="btn btn-primary">Modifier</button>
                                </div>
                            </form>
                    <?php endif; ?>
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