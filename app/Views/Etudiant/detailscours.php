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
    <style>
        /* Style général */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Header */
.dashboard-header {
    background-color: #007bff;
    color: white;
    padding: 20px 0;
    margin-bottom: 20px;
}

.dashboard-header h1 {
    margin: 0;
    font-size: 2.5rem;
}

.dashboard-header p {
    margin: 0;
    font-size: 1.2rem;
}

/* Contenu principal */
.course-details {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.course-details h2 {
    margin-top: 0;
    font-size: 2rem;
    display: flex;
    align-items: center;
}

.course-details h2 .back-button {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    margin-right: 10px;
    color: #007bff;
}

.course-details h2 .back-button:hover {
    color: #0056b3;
}

.course-details .text-muted {
    color: #6c757d;
    margin-bottom: 20px;
}

/* Conteneur vidéo ou document */
.video-container, .document-container {
    margin-bottom: 20px;
}

.video-container video {
    width: 100%;
    border-radius: 8px;
}

.document-container iframe {
    width: 100%;
    height: 500px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

/* Informations du cours */
.course-info {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.course-info h3 {
    margin-top: 0;
    font-size: 1.5rem;
}

.course-info .list-group {
    list-style: none;
    padding: 0;
}

.course-info .list-group-item {
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
}

.course-info .list-group-item:last-child {
    border-bottom: none;
}

.course-info .badge {
    background-color: #007bff;
    margin-right: 5px;
    font-size: 0.9rem;
}
    </style>
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