<?php

namespace Controllers;

use Exception;
use MVC\Router;
use Model\Permiso;
use Model\User;


class LoginController {
    public static function login(Router $router)
    {
        //isNotAuth();
        $router->render('auth/login', [], 'layouts/layout');
    }


    //FUNCION MENU
    public static function menu(Router $router)
    {
        // isAuth();
        // hasPermission(['LOGIN_ADMIN', 'USUARIO_ADMIN']);
        $router->render('pages/menu', [], 'layouts/menu');
    }

    //FUNCION PARA SALIR Y CERRAR SESION 
    public static function logout()
    {
        //isAuth();
        // $_SESSION = [];
        session_destroy();
        header('Location: /IS3_JIMENEZ_JENNIFER/');
        exit;
    }
    public static function loginAPI()
    {
        getHeadersApi();
        $_POST['us_email'] = filter_var($_POST['us_email'], FILTER_VALIDATE_EMAIL);
        $_POST['us_password'] = htmlspecialchars($_POST['us_password']);

  
        try {
            $usuario = new User($_POST);

            if ($usuario->validarUsuarioExistente()) {
  
                $usuarioBD = $usuario->usuarioExistente();
                //VALIDA QUE LA CONTRASEÑA ESTE CORRECTA
                if (password_verify($_POST['us_password'], $usuarioBD['us_password'])) {
                   // session_start();
                    $_SESSION['user'] = $usuarioBD;

     
                    $permisos = Permiso::fetchArray("SELECT * FROM permisos inner join roles on permisos_roles = roles_id where roles_situacion = 1 AND permisos_users = " . $usuarioBD['us_id']);
                    
                    foreach ($permisos as $permiso) {
                        $_SESSION[$permiso['roles_nombre']] = 1;
                    }

                    http_response_code(200);
                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => 'Bienvenido al sistema, ' . $usuarioBD['us_nombre'],
                    ]);
                    exit;
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'codigo' => 0,
                        'mensaje' => 'La constraseña no coincide',
                        'detalle' => 'Verifique la contraseña ingresada',
                    ]);
                    exit;
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'El usuario no existe',
                    'detalle' => 'No existe un usuario registrado con el catalogo proporcionado',
                ]);
                exit;
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al generar usuario',
                'detalle' => $e->getMessage(),
            ]);
            exit;
        }
    }
}