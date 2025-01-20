<?php
require_once("../../../vendor/autoload.php");
use App\Controllers\Enseignant\CourseController;
use App\Controllers\Enseignant\InscriptionController;

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
$courseController = new CourseController();
// $inscriptionController = new InscriptionController();

// $inscrits = $inscriptionController->getInscriptionsByCourse($courseId);

// Récupérer la liste des étudiants inscrits
$course = $courseController->trouvercourse($courseId);
$inscrits = $courseController->getInscriptionsByCourse($courseId);

// Gérer la désinscription
if (isset($_GET['desinscription_id'])) {
    $inscriptionId = $_GET['desinscription_id'];
    $courseController->desinscrireEtudiant($inscriptionId);
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
    <link rel="stylesheet" href="../assests/css/Enseignant/menuens.css">
    <link rel="stylesheet" href="../assests/css/Enseignant/gererens.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
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
                <a href="index.php" class="btn btn-outline-primary">
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
                                            <a href="inscriptions.php?course_id=<?php echo $courseId; ?>&desinscription_id=<?php echo $inscrit->getId(); ?>" 
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