<?php 

//para renderizar la vista
namespace Controllers;

use MVC\Router;

class MapaController {
    public static function index(Router $router){
        $router->render('mapa/index',[]);
    }
}