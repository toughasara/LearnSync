<?php 

use App\Controllers\Admin\CategorieController;
use App\Core\Router;

$router = new Router();

// Routes pour les catégories
$router->addRoute('GET', '/admin/categories', CategorieController::class, 'index');
$router->addRoute('GET', '/admin/categories/add', CategorieController::class, 'add');
$router->addRoute('POST', '/admin/categories/store', CategorieController::class, 'store');
$router->addRoute('GET', '/admin/categories/edit/{id}', CategorieController::class, 'edit');
$router->addRoute('POST', '/admin/categories/update/{id}', CategorieController::class, 'update');
$router->addRoute('GET', '/admin/categories/delete/{id}', CategorieController::class, 'delete');

return $router;