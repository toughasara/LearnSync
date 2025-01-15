<?php


    require_once("../../../../vendor/autoload.php");
    use App\Controllers\UtilisateurController;

    $utilisateurController = new UtilisateurController();

    $enseignants = $utilisateurController->getEnseignants();
    $etudiants = $utilisateurController->getEtudiants();

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
    <title>Utilisateurs - Youdemy</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assests/css/admin/dashbord.css">
    <link rel="stylesheet" href="../../assests/css/admin/affichens.css">
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="p-3">
        <h3 class="text-white mb-4 px-2">Youdemy</h3>
        <nav class="nav flex-column">
            <a href="../statistique.php" class="nav-link">
                <i class="bi bi-graph-up"></i> Statistiques
            </a>
            <a href="../Utilisateur/affichens.php" class="nav-link active">
                <i class="bi bi-briefcase"></i> Utilisateurs
            </a>
            <a href="../Categorie/categories.php" class="nav-link">
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
        <div class="header">
            <h1 class="fw-bold mb-2">Utilisateurs</h1>
            <p class="mb-0">Gérez les comptes étudiants et enseignants</p>
        </div>

        <!-- Teachers List -->
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Liste des Enseignants</h2>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date d'inscription</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($enseignants): ?>
                                    <?php foreach ($enseignants as $enseignant): ?>
                                        <tr>
                                            <input type="hidden" name="id" value="<?= $enseignant->getId() ?>">
                                            <?php echo '<td>' . $enseignant->getNom(). '</td>' ?>
                                            <?php echo '<td>' . $enseignant->getEmail(). '</td>' ?>
                                            <?php echo '<td>' . $enseignant->getCreatedAt(). '</td>' ?>
                                            <?php echo '<td><span class="status-badge status-' . $enseignant->getStatus() . '">' . $enseignant->getStatus() . '</span></td>'; ?>
                                            <td>
                                                <a href="#" class="action-btn suspend-btn"><i class="bi bi-pause-circle"></i></a>
                                                <a href="affichens.php?id=<?php echo $enseignant->getId(); ?>" class="action-btn delete-btn"><i class="bi bi-trash"></i></a>
                                                <?php if ($enseignant->getStatus() !== 'active'): ?>
                                                    <a href="#" class="action-btn activate-btn"><i class="bi bi-check-circle"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Students List -->
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-4">Liste des Étudiants</h2>
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date d'inscription</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($etudiants): ?>
                                    <?php foreach ($etudiants as $etudiant): ?>
                                        <tr>
                                            <input type="hidden" name="id" value="<?= $etudiant->getId() ?>">
                                            <?php echo '<td>' . $etudiant->getNom(). '</td>' ?>
                                            <?php echo '<td>' . $etudiant->getEmail(). '</td>' ?>
                                            <?php echo '<td>' . $etudiant->getCreatedAt(). '</td>' ?>
                                            <?php echo '<td><span class="status-badge status-' . $etudiant->getStatus() . '">' . $etudiant->getStatus() . '</span></td>'; ?>
                                            <td>
                                                <a href="#" class="action-btn suspend-btn"><i class="bi bi-pause-circle"></i></a>
                                                <a href="affichens.php?id=<?php echo $etudiant->getId(); ?>" class="action-btn delete-btn"><i class="bi bi-trash"></i></a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>