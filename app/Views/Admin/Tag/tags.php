<?php


    require_once("../../../../vendor/autoload.php");
    use App\Controllers\Admin\TagController;

    $tagController = new TagController();

    $tags = $tagController->getTags();

    if (isset($_GET['id'])) {
        $tag_id = $_GET['id'];
        $tagController->deleteTagById($tag_id);
        $tags = $tagController->getTags();
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

        <!-- Tags List -->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Liste des tags</h2>
                        <a href="ajouttag.php" class="add-btn">
                            <i class="bi bi-plus-lg me-2"></i> Ajouter une tag
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($tags): ?>
                                    <?php foreach ($tags as $tag): ?>
                                        <tr>
                                        <input type="hidden" name="id" value="<?= $tag->getId() ?>">
                                            <?php echo '<td>' . $tag->getNom(). '</td>' ?>
                                            <td>
                                                <a href="updatetag.php?id=<?php echo $tag->getId(); ?>" class="action-btn edit-btn me-2" title="Modifier"><i class="bi bi-pencil"></i></a>
                                                <a href="tags.php?id=<?php echo $tag->getId(); ?>" class="action-btn delete-btn" title="Supprimer"><i class="bi bi-trash"></i></a>
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
    <script src="../assests/js/dashbord.js"></script>
    <script src="../assests/js/tags.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>