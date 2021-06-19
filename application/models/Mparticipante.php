<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mparticipante extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'participante';
        parent::__construct($datos);
    }
}