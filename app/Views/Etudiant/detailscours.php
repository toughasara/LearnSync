<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "etudiant") {
    header("Location: ../../auth/login.php");
    exit();
}

require_once("../../../vendor/autoload.php");
use App\Controllers\Enseignant\CourseController;

$courseController = new CourseController();

// Récupérer l'ID du cours depuis l'URL
$courseId = isset($_GET['course_id']) ? (int)$_GET['course_id'] : 0;

if ($courseId === 0) {
    echo "ID de cours invalide.";
    exit();
}

// Récupérer les détails du cours
$course = $courseController->trouvercourse($courseId);

if (!$course) {
    echo "Cours non trouvé.";
    exit();
}
// // URLs de test
// $testVideoUrl = "https://www.w3schools.com/html/mov_bbb.mp4";
// $testDocumentUrl = "https://africau.edu/images/default/sample.pdf";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Cours - Youdemy</title>
    <link rel="stylesheet" href="../assests/css/Enseignant/menuens.css">
    <link rel="stylesheet" href="../assests/css/Enseignant/gererens.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="dashboard-header text-center">
        <div class="container">
            <h1>Détails du Cours</h1>
            <p><?php echo htmlspecialchars($course->getTitle()); ?></p>
        </div>
    </div>
    <div class="container">
        <div class="course-details">
            <!-- Bouton de retour -->
            <h2>
                <button class="back-button" onclick="window.history.back();">
                    <i class="bi bi-arrow-left"></i>
                </button>
                <?php echo htmlspecialchars($course->getTitle()); ?>
            </h2>
            <p class="text-muted"><?php echo htmlspecialchars($course->getDescription()); ?></p>
            
            <!-- Contenu vidéo ou document -->
            <?php if ($course->getContentType() === 'video'): ?>
                <div class="video-container">
                    <video controls width="100%">
                        <source src="<?php echo htmlspecialchars($course->getContentUrl()); ?>" type="video/mp4">
                        Votre navigateur ne supporte pas la lecture de vidéos.
                    </video>
                </div>
            <?php elseif ($course->getContentType() === 'document'): ?>
                <div class="document-container">
                    <iframe src="<?php echo htmlspecialchars($course->getContentUrl()); ?>" width="100%" height="500px"></iframe>
                </div>
            <?php endif; ?>
        </div>

        <!-- Informations du cours -->
        <div class="course-info">
            <h3>Informations du Cours</h3>
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Catégorie:</strong> <?php echo htmlspecialchars($course->getCategorie()->getNom()); ?>
                </li>
                <!-- <li class="list-group-item">
                    <strong>Créé par:</strong> <?php echo htmlspecialchars($course->getUtilisateur()->getNom()); ?>
                </li> -->
                <li class="list-group-item">
                    <strong>Date de publication:</strong> <?php echo htmlspecialchars($course->getCreatedAt()); ?>
                </li>
                <li class="list-group-item">
                    <?php foreach ($course->getTags() as $tag): ?>
                        <span class="badge bg-secondary"><?php echo htmlspecialchars($tag->getNom()); ?></span>
                    <?php endforeach; ?>
                </li>
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>