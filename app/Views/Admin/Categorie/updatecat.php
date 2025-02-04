<?php
    $categorie = $categorieController->trouvercategorie($id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Head content remains unchanged -->
</head>
<body>
    <!-- Sidebar and header content remains unchanged -->
    <div id="content">
        <!-- Header -->
        <div class="header mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="fw-bold mb-0">Modifier une catégorie</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <?php if ($categorie): ?>
                <form id="addCategoryForm" action="router.php?action=edit&id=<?= $id ?>" method="POST">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Nom de la catégorie</label>
                        <input value="<?php echo $categorie->getNom(); ?>" type="text" name="name" class="form-control" id="categoryName" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryDescription" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="categoryDescription" rows="3"><?php echo $categorie->getDescription(); ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <a href="router.php?action=index" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>