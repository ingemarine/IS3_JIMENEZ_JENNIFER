<?php
namespace Model;

class User extends ActiveRecord
{
    protected static $tabla = 'users';
    protected static $idTabla = 'us_id';

    protected static $columnasDB = ['us_nombre', 'us_email','us_password'];

    public $us_id;
    public $us_nombre;
    public $us_email;
    public $us_password;


    public function __construct($args = [])
    {
        $this->us_id = $args['us_id'] ?? null;
        $this->us_nombre = $args['us_nombre'] ?? '';
        $this->us_email = $args['us_email'] ?? 0;
        $this->us_password = $args['us_password'] ?? '';
      
    }

    public function validarUsuarioExistente() : bool
    {
        $sql = "SELECT * FROM users where us_email = ".$this->us_email."";
        $resultado = static::fetchArray($sql);
        return $resultado ? true : false;
    }
    public function usuarioExistente(): array
    {
    //modificar
        $sql = "SELECT us_id,us_nombre, us_password, us_email, roles_nombre from permisos inner join users on permisos_users = us_id inner join roles on roles_id = permisos_roles inner join envios on rol_app = app_id where permiso_situacion = 1 AND rol_situacion = 1 AND usu_catalogo = ".$this->us_email."";

        $resultado = static::fetchFirst($sql);
        return $resultado;
}

}