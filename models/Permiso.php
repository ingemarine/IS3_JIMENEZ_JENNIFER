<?php

namespace Model;

class Permiso extends ActiveRecord{
    public static $tabla = 'permisos';
    public static $columnasDB = ['permisos_users', 'permisos_roles'];
    public static $idTabla = 'permisos_id';

    public $permisos_id;
    public $permisos_users;
    public $permisos_roles;


    public function __construct($args =[])
    {
        $this->permisos_id = $args['permisos_id'] ?? null;
        $this->permisos_users = $args['permisos_users'] ?? '';
        $this->permisos_roles = $args['permisos_roles'] ?? '';

    }

}