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
                    <h1 class="fw-bold mb-0">Ajouter une catégorie</h1>
                </div>
            </div>
        </div>
        <div class="container">
            <form id="addCategoryForm" action="router.php?action=add" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Nom de la catégorie</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <a href="router.php?action=index" class="btn btn-secondary">Annuler</a>
                    <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
    <!-- js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>