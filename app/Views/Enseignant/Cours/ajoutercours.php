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
<body class="bg-light">
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
                    <button class="menu-btn">
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
                    <button class="menu-btn">
                        <i class="bi bi-graph-up"></i>
                        Statistiques
                    </button>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h2 class="mb-4">Nouveau Cours</h2>
            <form>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Titre du cours*</label>
                        <input type="text" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Description*</label>
                        <textarea class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Type de contenu*</label>
                        <select class="form-select" required>
                            <option value="">Sélectionner</option>
                            <option value="video">Vidéo</option>
                            <option value="document">Document</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">URL du contenu*</label>
                        <input type="text" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Catégorie*</label>
                        <select class="form-select" required>
                            <option value="">Sélectionner</option>
                            <option value="1">Développement Web</option>
                            <option value="2">Design</option>
                            <option value="3">Marketing</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Tags</label>
                        <div class="tag-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1">
                                <label class="form-check-label">HTML</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="2">
                                <label class="form-check-label">CSS</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="3">
                                <label class="form-check-label">JavaScript</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="4">
                                <label class="form-check-label">PHP</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Publier le cours
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>