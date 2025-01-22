<?php


    require_once("../../../../vendor/autoload.php");
    use App\Controllers\UtilisateurController;

    $utilisateurController = new UtilisateurController();

    $enseignants = $utilisateurController->getEnseignants();
    $etudiants = $utilisateurController->getEtudiants();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];

        if(isset($_POST['status'])){
            $status = $_POST['status'];
            $utilisateurController->updateUserStatus($id, $status);
        }
        else{
            $utilisateurController->softDeleteUser($id);
        }
    
        $enseignants = $utilisateurController->getEnseignants();
        $etudiants = $utilisateurController->getEtudiants();

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
            <a href="../index.php" class="nav-link">
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
                                            <?php 
                                                $status = ($enseignant->getDeletedAt() !== null) ? 'deleted' : $enseignant->getStatus();
                                                echo '<td><span class="status-badge status-' . $status . '">' . $status . '</span></td>'; 
                                            ?>
                                            <td>
                                                <!-- suspended -->
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $enseignant->getId() ?>">
                                                    <input type="hidden" name="status" value="suspended">
                                                    <button type="submit" class="action-btn suspend-btn">
                                                        <i class="bi bi-pause-circle"></i>
                                                    </button>
                                                </form>
                                                <!-- Activer -->
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $enseignant->getId() ?>">
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="action-btn activate-btn">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                                <!-- inactive -->
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $enseignant->getId() ?>">
                                                    <input type="hidden" name="status" value="inactive">
                                                    <button type="submit" class="action-btn deactivate-btn">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                                <!-- Soft Delete -->
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $enseignant->getId() ?>">
                                                    <button type="submit" class="action-btn delete-btn">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
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
                                            <?php 
                                                $status = ($etudiant->getDeletedAt() !== null) ? 'deleted' : $etudiant->getStatus();
                                                echo '<td><span class="status-badge status-' . $status . '">' . $status . '</span></td>'; 
                                            ?>
                                            <td>
                                                <!-- suspended -->
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $etudiant->getId() ?>">
                                                    <input type="hidden" name="status" value="suspended">
                                                    <button type="submit" class="action-btn suspend-btn">
                                                        <i class="bi bi-pause-circle"></i>
                                                    </button>
                                                </form>
                                                <!-- Activer -->
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $etudiant->getId() ?>">
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="action-btn activate-btn">
                                                        <i class="bi bi-check-circle"></i>
                                                    </button>
                                                </form>
                                                <!-- inactive -->
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $etudiant->getId() ?>">
                                                    <input type="hidden" name="status" value="inactive">
                                                    <button type="submit" class="action-btn deactivate-btn">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                                <!-- Soft Delete -->
                                                <form action="" method="POST" style="display: inline;">
                                                    <input type="hidden" name="id" value="<?= $etudiant->getId() ?>">
                                                    <button type="submit" class="action-btn delete-btn">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
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