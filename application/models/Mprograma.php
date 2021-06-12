<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mprograma extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'programa';
        parent::__construct($datos);
    }
}