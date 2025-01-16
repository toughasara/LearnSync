<?php
    session_start();

    require_once("../../../../vendor/autoload.php");
    use App\Controllers\CategorieController;
    use App\Controllers\TagController;

    $categorieController = new CategorieController();
    // Instancier le TagController
    $tagController = new TagController();

    $categories = $categorieController->getCategories();
    // Récupérer les tags
    $tags = $tagController->getTags();
    
    if(isset($_POST["submit"]))
    {
        if(empty($_POST["title"]) || empty($_POST["description"]) || empty($_POST["content_type"]) || empty($_POST["content_url"]) || empty($_POST["category_id"]))
        {
            echo '<div class="alert alert-danger">Tous les champs sont obligatoires</div>';
        }
        else {
            $title = $_POST["title"];
            $description = $_POST["description"];
            $content_type = $_POST["content_type"];
            $content_url = $_POST["content_url"];
            $category_id = $_POST["category_id"];
            $selectedTags = isset($_POST["tags"]) ? $_POST["tags"] : [];
            
            // Ajouter le cours
            $courseController->addCourse($title, $description, $content_type, $content_url, $_SESSION['user_id'], $category_id, $selectedTags);

            header("Location: courses.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Cours - Youdemy</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assests/css/Enseignant/menuens.css">
    <link rel="stylesheet" href="../../assests/css/Enseignant/ajoutens.css">
</head>
<body>
    <div class="dashboard-header text-center">
        <div class="container">
            <h1>Gestion des Cours</h1>
            <p>Créez et gérez vos cours en ligne</p>
        </div>
    </div>

    <div class="container">
        <div class="menu-buttons">
            <div class="row g-3">
                <div class="col-12 col-md-4">
                    <button class="menu-btn" onclick="window.location.href='index.php'">
                        <i class="bi bi-collection"></i>
                        Mes Cours
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button class="menu-btn active">
                        <i class="bi bi-plus-circle"></i>
                        Ajouter un Cours
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button class="menu-btn" onclick="window.location.href='statistics.php'">
                        <i class="bi bi-graph-up"></i>
                        Statistiques
                    </button>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2>Nouveau Cours</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Titre du cours*</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description*</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Type de contenu*</label>
                        <select class="form-select" name="content_type" required>
                            <option value="">Sélectionner</option>
                            <option value="video">Vidéo</option>
                            <option value="document">Document</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">URL du contenu*</label>
                        <input type="text" class="form-control" name="content_url" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Catégorie*</label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Sélectionner</option>
                            <?php if(isset($categories) && !empty($categories)): ?>
                                <?php foreach($categories as $category): ?>
                                    <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Catégorie*</label>
                        <select class="form-select" name="category_id" required>
                            <option value="">Sélectionner</option>
                            <?php if(isset($categories) && !empty($categories)): ?>
                                <?php foreach($categories as $category): ?>
                                    <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Tags</label>
                        <div class="row g-3">
                            <?php if(isset($tags) && !empty($tags)): ?>
                                <?php foreach($tags as $tag): ?>
                                    <div class="col-auto">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tags[]" value="<?= $tag->getId() ?>">
                                            <label class="form-check-label"><?= $tag->getName() ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Publier le cours
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>