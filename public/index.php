<?php


require_once __DIR__.'/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\ContactController;
use App\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', [ContactController::class, 'home']);
$app->router->post('/contact', [ContactController::class, 'contact']);
$app->router->get('/contact', [ContactController::class, 'handleContact']);

// ======= Login =========
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);


$app->run();