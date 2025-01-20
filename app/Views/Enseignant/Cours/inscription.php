<?php
require_once("../../../../vendor/autoload.php");
use App\Controllers\Enseignant\InscriptionController;
use App\Controllers\Enseignant\CourseController;


session_start();

if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "enseignant") {
    header("Location: ../../Auth/login.php");
    exit();
}

if (!isset($_GET['course_id'])) {
    header("Location: index.php");
    exit();
}

$courseId = $_GET['course_id'];
$inscriptionController = new InscriptionController();
$courseController = new CourseController();

$course = $courseController->trouvercourse($courseId);

// Récupérer la liste des étudiants inscrits
$inscrits = $inscriptionController->getInscriptionsByCourse($courseId);

// Gérer la désinscription
if (isset($_GET['desinscription_id'])) {
    $inscriptionId = $_GET['desinscription_id'];
    $inscriptionController->desinscrireEtudiant($inscriptionId);
    // Rediriger pour éviter la resoumission du formulaire
    header("Location: inscription.php?course_id=" . $courseId);
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Inscrits - <?php echo htmlspecialchars($course->getTitle()); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
    --primary-color: #2C3E50;
    --secondary-color: #3498DB;
    --accent-color: #E74C3C;
    --light-gray: #F8F9FA;
}

body {
    background-color: var(--light-gray);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.dashboard-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 2rem 0;
    margin-bottom: 2rem;
}

.menu-buttons {
    background-color: white;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.menu-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    transition: all 0.3s ease;
    background-color: var(--light-gray);
    color: var(--primary-color);
    border: none;
    text-decoration: none !important;
}

.menu-btn:link,
.menu-btn:visited,
.menu-btn:hover,
.menu-btn:active {
    text-decoration: none !important;
    color: inherit;
}

.menu-buttons a {
    text-decoration: none !important;
}

.menu-btn:hover, .menu-btn.active {
    background-color: var(--secondary-color);
    color: white;
    text-decoration: none !important;
}
.course-card {
    background-color: white;
    border-radius: 8px;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    transition: transform 0.2s ease;
    height: 100%;
}

.course-card:hover {
    transform: translateY(-2px);
}

.course-image {
    height: 200px;
    overflow: hidden;
    border-radius: 8px 8px 0 0;
}

.course-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.course-content {
    padding: 1.5rem;
}

.tag {
    background-color: var(--light-gray);
    color: var(--primary-color);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    display: inline-block;
}

.pagination {
    justify-content: center;
    margin-top: 2rem;
    margin-bottom: 2rem;
}

.page-link {
    color: var(--primary-color);
    border-color: var(--secondary-color);
}

.page-item.active .page-link {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
}

@media (max-width: 768px) {
    .menu-buttons .row > div {
        margin-bottom: 1rem;
    }
}
    </style>
</head>
<body class="bg-light">
    <div class="dashboard-header text-center">
        <div class="container">
            <h1>Liste des Étudiants Inscrits</h1>
            <p>Cours : <?php echo htmlspecialchars($course->getTitle()); ?></p>
        </div>
    </div>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Étudiants inscrits</h5>
                <a href="../index.php" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left me-2"></i>Retour aux cours
                </a>
            </div>
            <div class="card-body">
                <?php if (empty($inscrits)): ?>
                    <div class="alert alert-info">
                        Aucun étudiant n'est inscrit à ce cours pour le moment.
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Date d'inscription</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($inscrits as $inscrit): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($inscrit->getEtudiant()->getNom()); ?></td>
                                        <td><?php echo htmlspecialchars($inscrit->getEtudiant()->getEmail()); ?></td>
                                        <td><?php echo htmlspecialchars($inscrit->getDateInscription()); ?></td>
                                        <td>
                                            <a href="inscription.php?course_id=<?php echo $courseId; ?>&desinscription_id=<?php echo $inscrit->getId(); ?>" 
                                            class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-person-x me-1"></i>Désinscrire
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>