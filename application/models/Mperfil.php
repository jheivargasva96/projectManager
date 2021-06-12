<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mperfil extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'perfil';
        parent::__construct($datos);
    }
}