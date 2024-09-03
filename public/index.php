<?php 
require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AppController;
use Controllers\LoginController;
use Controllers\DetalleController;
use Controllers\MapaController;

$router = new Router();
$router->setBaseURL('/' . $_ENV['APP_NAME']);

$router->get('/', [LoginController::class,'index']);
$router->post('/API/login', [LoginController::class,'loginAPI']);

$router->get('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/menu', [LoginController::class, 'menu']);
$router->get('/registro', [LoginController::class, 'registro']);
$router->post('/API/registro', [LoginController::class, 'registroAPI']);
$router->post('/API/login', [LoginController::class, 'loginAPI']);


$router->get( '/login', [Controllers\LoginController::class, 'login']);



//detalle
// DETALLE
$router->get('/productos/estadisticas', [DetalleController::class, 'estadisticas']);
$router->get('/API/detalle/estadisticas', [DetalleController::class, 'detalleVentasAPI']);


//ruta mapa 
$router->get('/mapa', [MapaController::class, 'index']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
