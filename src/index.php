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
use myapp\controllers\ThongKeController;
use myapp\controllers\ViphamController;
use myapp\database\Database;

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
error_reporting(E_ALL);
Database::init();
$router = new Router();
// $apacheUrl = '/eautlib/src'; //WHEN USE APACHE VIRTUAL HOST, MAKE EMPTY IF USE php -S
$apacheUrl = '';

$router->get($apacheUrl . '/', [SachController::class, 'guestView']);
$router->get($apacheUrl . '/books', [SachController::class, 'guestRead']);
$router->get($apacheUrl . '/auth/login', [AuthController::class, 'login']);
$router->post($apacheUrl . '/auth/login', [AuthController::class, 'login']);
$router->get($apacheUrl . '/auth/logout', [AuthController::class, 'logout']);

$router->get($apacheUrl . '/admin/', [SachController::class, 'index']);
$router->get($apacheUrl . '/admin', [SachController::class, 'index']);
$router->get($apacheUrl . '/admin/accounts', [AccountController::class, 'index']);
$router->get($apacheUrl . '/admin/accounts/', [AccountController::class, 'index']);
$router->get($apacheUrl . '/admin/accounts/create', [AccountController::class, 'create']);
$router->get($apacheUrl . '/admin/accounts/update', [AccountController::class, 'update']);
$router->get($apacheUrl . '/admin/accounts/delete', [AccountController::class, 'delete']);
$router->get($apacheUrl . '/admin/accounts/changepassword', [AccountController::class, 'changePass']);


$router->get($apacheUrl . '/admin/books', [SachController::class, 'index']);
$router->get($apacheUrl . '/admin/books/', [SachController::class, 'index']);
$router->get($apacheUrl . '/admin/books/create', [SachController::class, 'create']);
$router->post($apacheUrl . '/admin/books/create', [SachController::class, 'create']);
$router->get($apacheUrl . '/admin/books/update', [SachController::class, 'update']);
$router->post($apacheUrl . '/admin/books/update', [SachController::class, 'update']);
$router->post($apacheUrl . '/admin/books/delete', [SachController::class, 'delete']);

$router->get($apacheUrl . '/admin/authors', [TacgiaController::class, 'index']);
$router->get($apacheUrl . '/admin/authors/', [TacgiaController::class, 'index']);
$router->get($apacheUrl . '/admin/authors/create', [TacgiaController::class, 'create']);
$router->post($apacheUrl . '/admin/authors/create', [TacgiaController::class, 'create']);
$router->get($apacheUrl . '/admin/authors/update', [TacgiaController::class, 'update']);
$router->post($apacheUrl . '/admin/authors/update', [TacgiaController::class, 'update']);
$router->post($apacheUrl . '/admin/authors/delete', [TacgiaController::class, 'delete']);

$router->get($apacheUrl . '/admin/violations', [ViphamController::class, 'index']);
$router->get($apacheUrl . '/admin/violations/', [ViphamController::class, 'index']);
$router->get($apacheUrl . '/admin/violations/create', [ViphamController::class, 'create']);
$router->post($apacheUrl . '/admin/violations/create', [ViphamController::class, 'create']);
$router->get($apacheUrl . '/admin/violations/update', [ViphamController::class, 'update']);
$router->post($apacheUrl . '/admin/violations/update', [ViphamController::class, 'update']);
$router->post($apacheUrl . '/admin/violations/delete', [ViphamController::class, 'delete']);

$router->get($apacheUrl . '/admin/readers', [BandocController::class, 'index']);
$router->get($apacheUrl . '/admin/readers/', [BandocController::class, 'index']);
$router->get($apacheUrl . '/admin/readers/create', [BandocController::class, 'create']);
$router->post($apacheUrl . '/admin/readers/create', [BandocController::class, 'create']);
$router->get($apacheUrl . '/admin/readers/update', [BandocController::class, 'update']);
$router->post($apacheUrl . '/admin/readers/update', [BandocController::class, 'update']);
$router->post($apacheUrl . '/admin/readers/delete', [BandocController::class, 'delete']);

$router->get($apacheUrl . '/admin/genres', [TheloaiController::class, 'index']);
$router->get($apacheUrl . '/admin/genres/', [TheloaiController::class, 'index']);
$router->get($apacheUrl . '/admin/genres/create', [TheloaiController::class, 'create']);
$router->post($apacheUrl . '/admin/genres/create', [TheloaiController::class, 'create']);
$router->get($apacheUrl . '/admin/genres/update', [TheloaiController::class, 'update']);
$router->post($apacheUrl . '/admin/genres/update', [TheloaiController::class, 'update']);
$router->post($apacheUrl . '/admin/genres/delete', [TheloaiController::class, 'delete']);

$router->get($apacheUrl . '/admin/borrows', [MuonTraController::class, 'index']);
$router->get($apacheUrl . '/admin/borrows/', [MuonTraController::class, 'index']);
$router->get($apacheUrl . '/admin/borrows/create', [MuonTraController::class, 'create']);
$router->post($apacheUrl . '/admin/borrows/create', [MuonTraController::class, 'create']);
$router->get($apacheUrl . '/admin/borrows/update', [MuonTraController::class, 'update']);
$router->post($apacheUrl . '/admin/borrows/update', [MuonTraController::class, 'update']);
$router->post($apacheUrl . '/admin/borrows/delete', [MuonTraController::class, 'delete']);
$router->post($apacheUrl . '/admin/borrows/return', [MuonTraController::class, 'returnCard']);
$router->post($apacheUrl . '/admin/borrows/removebook', [MuonTraController::class, 'removeBook']);

$router->get($apacheUrl . '/api/book', [SachAPI::class, 'getById']);
$router->post($apacheUrl . '/api/book/borrow', [SachAPI::class, 'addBookToCard']);
$router->post($apacheUrl . '/api/book/return', [SachAPI::class, 'removeBookFromCard']);

$router->get($apacheUrl . '/admin/analytics', [ThongKeController::class, 'index']);
$router->get($apacheUrl . '/admin/analytics/', [ThongKeController::class, 'index']);

$router->resolve();