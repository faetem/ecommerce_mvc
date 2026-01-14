<?php


declare(strict_types=1);

session_start();

require dirname(path: __DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes minimaliste
$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    ['POST', '/users', [Mini\Controllers\HomeController::class, 'createUser']],
    ['GET', '/users/create', [Mini\Controllers\HomeController::class, 'showCreateUserForm']],
    ['GET', '/products', [Mini\Controllers\ProductController::class, 'listProducts']],
    ['GET', '/products/show', [Mini\Controllers\ProductController::class, 'index']],
    ['GET', '/products/create', [Mini\Controllers\ProductController::class, 'showCreateProductForm']],
    ['POST', '/products', [Mini\Controllers\ProductController::class, 'createProduct']],
    // Routes pour le panier
    ['GET', '/cart', [Mini\Controllers\CartController::class, 'index']],
    ['POST', '/cart/add', [Mini\Controllers\CartController::class, 'add']],
    ['POST', '/cart/add-from-form', [Mini\Controllers\CartController::class, 'addFromForm']],
    ['POST', '/cart/update', [Mini\Controllers\CartController::class, 'update']],
    ['POST', '/cart/remove', [Mini\Controllers\CartController::class, 'remove']],
    ['POST', '/cart/clear', [Mini\Controllers\CartController::class, 'clear']],
    // Routes pour les commandes
    ['GET', '/orders', [Mini\Controllers\OrderController::class, 'listByUser']],
    ['GET', '/orders/validated', [Mini\Controllers\OrderController::class, 'listValidated']],
    ['GET', '/orders/show', [Mini\Controllers\OrderController::class, 'show']],
    ['POST', '/orders/create', [Mini\Controllers\OrderController::class, 'create']],
    ['POST', '/orders/update-status', [Mini\Controllers\OrderController::class, 'updateStatus']],
    // Routes pour l'authentification 
    ['GET', '/auth/register', [Mini\Controllers\AuthController::class, 'showRegisterForm']],
    ['POST', '/auth/register', [Mini\Controllers\AuthController::class, 'register']],
    ['GET', '/auth/login', [Mini\Controllers\AuthController::class, 'showLoginForm']],
    ['POST', '/auth/login', [Mini\Controllers\AuthController::class, 'login']],
    ['GET', '/auth/logout', [Mini\Controllers\AuthController::class, 'logout']],
    // Routes pour l'admin 
    ['GET', '/admin', [Mini\Controllers\AdminController::class, 'index']],
    ['GET', '/admin/users', [Mini\Controllers\AdminController::class, 'listUsers']],
    ['POST', '/admin/create-user', [Mini\Controllers\AdminController::class, 'createUser']],
    ['GET', '/admin/create-user', [Mini\Controllers\AdminController::class, 'showCreateUserForm']],
    ['POST', '/admin/users/delete', [Mini\Controllers\AdminController::class, 'deleteUser']],
    ['GET', '/admin/edit-user', [Mini\Controllers\AdminController::class, 'showEditUserForm']],
    ['POST', '/admin/edit-user', [Mini\Controllers\AdminController::class, 'updateUser']],
    ['GET', '/admin/order-list', [Mini\Controllers\AdminController::class, 'listOrders']]
];
// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
