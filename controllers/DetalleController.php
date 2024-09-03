<?php

namespace Controllers;

use Exception;
use Model\Cliente;
use Model\User;
use MVC\Router;

class DetalleController
{

    public static function estadisticas(Router $router)
    {
        $router->render('envios/estadisticas', [], 'layouts/menu'); // lo reenderice a envios
    }


    public static function detalleVentasAPI()
    {
        try {

            $sql = 'SELECT US_NOMBRE AS USERS, SUM (DETALLE_CANTIDAD) AS CANTIDAD_ENVIO FROM DETALLE_ENVIO INNER JOIN USERS ON DETALLE_USER = US_ID WHERE DETALLE_SITUACION = 1 GROUP BY US_NOMBRE';
            $datos = User::fetchArray($sql);
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
