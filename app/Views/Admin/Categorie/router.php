<?php

require_once("../../../../vendor/autoload.php");
use App\Controllers\Admin\CategorieController;

$categorieController = new CategorieController();

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'index':
        // $categories = $categorieController->getCategories();
        include 'categories.php';
        break;
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['name'];
            $description = $_POST['description'];
            $categorieController->addcategorie($nom, $description);
            header("Location: router.php?action=index");
            exit;
        }
        include 'ajoutcat.php';
        break;
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['name'];
            $description = $_POST['description'];
            $categorieController->updateCategorie($id, $nom, $description);
            header("Location: router.php?action=index");
            exit;
        }
        // $categorie = $categorieController->trouvercategorie($id);
        include 'updatecat.php';
        break;
    case 'delete':
        $categorieController->deleteCategoryById($id);
        header("Location: router.php?action=index");
        exit;
        break;
    default:
        include 'erreur.php';
        exit;
}