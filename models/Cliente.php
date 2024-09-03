<?php

namespace Model;

class Cliente extends ActiveRecord
{
    protected static $tabla = 'clientes';
    protected static $idTabla = 'cli_id';
    protected static $columnasDB = ['cli_nombre', 'cli_situacion', 'cli_apellido', 'cli_nit', 'cli_telefono', 'cli_situacion'];

    public $cli_id;
    public $cli_nombre;
    public $cli_apellido;

    public $cli_nit;

    public $cli_telefono;

    public $cli_situacion;

    public function __construct($args = [])
    {
        $this->cli_id = $args['cli_id'] ?? null;
        $this->cli_nombre = $args['cli_nombre'] ?? '';
        $this->cli_nombre = $args['cli_apellido'] ?? '';
        $this->cli_nombre = $args['cli_nit'] ?? '';
        $this->cli_nombre = $args['cli_telefono'] ?? '';
        $this->cli_situacion = $args['cli_situacion'] ?? 1;
    }

}