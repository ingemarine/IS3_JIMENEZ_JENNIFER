<?php

namespace Controllers;

use Exception;
use Model\Permiso;
use Model\User;
use MVC\Router;

class LoginController
{
    //funcion para entrar a menu
    public static function login(Router $router)
    {
        isNotAuth();
        $router->render('auth/login', []);
    }

    public static function logout()
    {
         isAuth();
         $_SESSION = [];   //descomentariar si quiero que los demas usuarios no entren a las tablas
        session_destroy();
        header('Location: /IS3_JIMENEZ_JENNIFER/');
        exit;
    }

    //funcion para que tenga permisos 
    
    // public static function registro(Router $router)
    // {
    //     isAuth();
    //     hasPermission(['TIENDA_ADMIN']);
    //     $router->render('auth/registro', [], 'layouts/menu');
    // }

    //ESTA FUNCION ES PARA QUE INGRESE SOLO EL QUE ES TIENDA_ADMIN
    public static function menu(Router $router)
    {
        // isAuth();
        // hasPermission(['TIENDA_ADMIN', 'TIENDA_USER']);
        $router->render('pages/menu', [], 'layouts/menu');
    }


    public static function loginAPI()
    {
        getHeadersApi();

        // Sanitización de entradas
        $us_email = filter_var($_POST['us_email'], FILTER_SANITIZE_NUMBER_INT);
        $us_password = htmlspecialchars($_POST['us_password']);

        try {
            // Validación del usuario
            $usuario = new User(['us_email' => $us_email]);
            if ($usuario->validarUsuarioExistente()) {
                $usuarioBD = $usuario->UsuarioExistente();

                // Verificación de la contraseña
                if (password_verify($us_password, $usuarioBD['us_password'])) {
                    session_start();
                    $_SESSION['user'] = $usuarioBD;

                    // Obtención y configuración de permisos en la sesión
                    $permisos = Permiso::fetchArray("SELECT * FROM permisos INNER JOIN roles ON permisos_roles = roles_id WHERE permisos_users = " . $usuarioBD['us_id']);
                    foreach ($permisos as $permiso) {
                        $_SESSION[$permiso['roles_nombre']] = 1;
                    }

                    http_response_code(200);
                    echo json_encode([
                        'codigo' => 1,
                        'mensaje' => 'Bienvenido a nuestro sistema, ' . $usuarioBD['us_nombre'],
                    ]);
                } else {
                    http_response_code(401); // Código de estado para credenciales inválidas
                    echo json_encode([
                        'codigo' => 0,
                        'mensaje' => 'La contraseña no coincide',
                        'detalle' => 'Verifique la contraseña ingresada',
                    ]);
                }
            } else {
                http_response_code(404); // Código de estado para usuario no encontrado
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'El usuario no existe',
                    'detalle' => 'No existe un usuario registrado con el catálogo proporcionado',
                ]);
            }
        } catch (Exception $e) {
            http_response_code(500); // Código de estado para errores del servidor
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al iniciar sesión',
                'detalle' => $e->getMessage(),
            ]);
        }
        exit;
    }

    
}
