<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mindicador extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'indicador';
        parent::__construct($datos);
    }
}