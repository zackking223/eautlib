<?php
session_start();

require '../vendor/autoload.php';

use myapp\api\SachAPI;
use myapp\controllers\AccountController;
use myapp\controllers\AuthController;
use myapp\controllers\BandocController;
use myapp\controllers\MuonTraController;
use myapp\Router;
use myapp\controllers\SachController;
use myapp\controllers\TacgiaController;
use myapp\controllers\TheloaiController;
use myapp\controllers\ViphamController;
use myapp\database\Database;

Database::init();
$router = new Router();

$router->get('/', [SachController::class, 'guestView']);
$router->get('/books', [SachController::class, 'guestRead']);
$router->get('/auth/login', [AuthController::class, 'login']);
$router->post('/auth/login', [AuthController::class, 'login']);
$router->get('/auth/logout', [AuthController::class, 'logout']);

$router->get('/admin/', [SachController::class, 'index']);
$router->get('/admin', [SachController::class, 'index']);
$router->get('/admin/accounts', [AccountController::class, 'index']);
$router->get('/admin/accounts/', [AccountController::class, 'index']);
$router->get('/admin/accounts/create', [AccountController::class, 'create']);
$router->get('/admin/accounts/update', [AccountController::class, 'update']);
$router->get('/admin/accounts/delete', [AccountController::class, 'delete']);
$router->get('/admin/accounts/changepassword', [AccountController::class, 'changePass']);


$router->get('/admin/books', [SachController::class, 'index']);
$router->get('/admin/books/', [SachController::class, 'index']);
$router->get('/admin/books/create', [SachController::class, 'create']);
$router->post('/admin/books/create', [SachController::class, 'create']);
$router->get('/admin/books/update', [SachController::class, 'update']);
$router->post('/admin/books/update', [SachController::class, 'update']);
$router->post('/admin/books/delete', [SachController::class, 'delete']);

$router->get('/admin/authors', [TacgiaController::class, 'index']);
$router->get('/admin/authors/', [TacgiaController::class, 'index']);
$router->get('/admin/authors/create', [TacgiaController::class, 'create']);
$router->post('/admin/authors/create', [TacgiaController::class, 'create']);
$router->get('/admin/authors/update', [TacgiaController::class, 'update']);
$router->post('/admin/authors/update', [TacgiaController::class, 'update']);
$router->post('/admin/authors/delete', [TacgiaController::class, 'delete']);

$router->get('/admin/violations', [ViphamController::class, 'index']);
$router->get('/admin/violations/', [ViphamController::class, 'index']);
$router->get('/admin/violations/create', [ViphamController::class, 'create']);
$router->post('/admin/violations/create', [ViphamController::class, 'create']);
$router->get('/admin/violations/update', [ViphamController::class, 'update']);
$router->post('/admin/violations/update', [ViphamController::class, 'update']);
$router->post('/admin/violations/delete', [ViphamController::class, 'delete']);

$router->get('/admin/readers', [BandocController::class, 'index']);
$router->get('/admin/readers/', [BandocController::class, 'index']);
$router->get('/admin/readers/create', [BandocController::class, 'create']);
$router->post('/admin/readers/create', [BandocController::class, 'create']);
$router->get('/admin/readers/update', [BandocController::class, 'update']);
$router->post('/admin/readers/update', [BandocController::class, 'update']);
$router->post('/admin/readers/delete', [BandocController::class, 'delete']);

$router->get('/admin/genres', [TheloaiController::class, 'index']);
$router->get('/admin/genres/', [TheloaiController::class, 'index']);
$router->get('/admin/genres/create', [TheloaiController::class, 'create']);
$router->post('/admin/genres/create', [TheloaiController::class, 'create']);
$router->get('/admin/genres/update', [TheloaiController::class, 'update']);
$router->post('/admin/genres/update', [TheloaiController::class, 'update']);
$router->post('/admin/genres/delete', [TheloaiController::class, 'delete']);

$router->get('/admin/borrows', [MuonTraController::class, 'index']);
$router->get('/admin/borrows/', [MuonTraController::class, 'index']);
$router->get('/admin/borrows/create', [MuonTraController::class, 'create']);
$router->post('/admin/borrows/create', [MuonTraController::class, 'create']);
$router->get('/admin/borrows/update', [MuonTraController::class, 'update']);
$router->post('/admin/borrows/update', [MuonTraController::class, 'update']);
$router->post('/admin/borrows/delete', [MuonTraController::class, 'delete']);
$router->post('/admin/borrows/return', [MuonTraController::class, 'returnCard']);
$router->post('/admin/borrows/removebook', [MuonTraController::class, 'removeBook']);

$router->get('/api/book', [SachAPI::class, 'getById']);
$router->post('/api/book/borrow', [SachAPI::class, 'addBookToCard']);
$router->post('/api/book/return', [SachAPI::class, 'removeBookFromCard']);

$router->resolve();