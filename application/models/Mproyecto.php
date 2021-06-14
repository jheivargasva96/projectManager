<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mproyecto extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'proyecto';
        parent::__construct($datos);
    }
}