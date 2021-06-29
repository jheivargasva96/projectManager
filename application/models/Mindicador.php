<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mindicador extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'indicador';
        parent::__construct($datos);
    }

    public function CountState($state, $parentId)
    {
        $this->db->select('count(*) as cant');
        $this->db->from($this->tabla);
        $this->db->where('estado', $state);
        $this->db->where('proyecto_idproyecto', $parentId);
        $query = $this->db->get()->row();
        return $query->cant;
    }

    public function CountParent($parentId)
    {
        $this->db->select('count(*) as cant');
        $this->db->from($this->tabla);
        $this->db->where('proyecto_idproyecto', $parentId);
        $query = $this->db->get()->row();
        return $query->cant;
    }

    public function consultarCumplimiento()
    {
        try {
            
            $this->db->select('cumplimiento');
            $query = $this->db->get($this->tabla);
            return $query->result();
        } catch (\Throwable $th) {
            return false;
        }

    }
}