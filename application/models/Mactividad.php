<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mactividad extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'actividad';
        parent::__construct($datos);
    }
}