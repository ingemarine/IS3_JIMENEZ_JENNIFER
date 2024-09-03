<?php

namespace Controllers;

use Exception;
use Model\Cliente; 
use MVC\Router; 

class DetalleController {

    public static function estadisticas(Router $router){
        $router->render('productos/estadisticas');
    }


    public static function detalleVentasAPI(){
        try {

            $sql = 'SELECT CLI_NOMBRE AS CLIENTE, SUM (DETALLE_CANTIDAD) AS CANTIDAD_PRODUCTOS FROM DETALLE_VENTA INNER JOIN CLIENTES ON DETALLE_CLIENTE = CLI_ID WHERE DETALLE_SITUACION = 1 GROUP BY CLI_NOMBRE';

            $datos = Cliente::fetchArray($sql);
            
            echo json_encode($datos);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error', 
                'codigo' => 0
            ]);
        }
    }

}