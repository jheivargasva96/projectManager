<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mtipo_identificacion extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'tipo_identificacion';
        parent::__construct($datos);
    }
}