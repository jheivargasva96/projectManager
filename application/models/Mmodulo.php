<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mmodulo extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'modulo';
        parent::__construct($datos);
    }
}
