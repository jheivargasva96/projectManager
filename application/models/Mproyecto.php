<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mproyecto extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'proyecto';
        parent::__construct($datos);
    }
    
    public function CountState($state, $parentId)
    {
        $this->db->select('count(*) as cant');
        $this->db->from($this->tabla);
        $this->db->where('estado', $state);
        $this->db->where('programa_idprograma', $parentId);
        $query = $this->db->get()->row();
        return $query->cant;
    }
}