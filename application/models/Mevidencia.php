<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mevidencia extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'evidencia';
        parent::__construct($datos);
    }

    public function last($parent)
    {
        try {
            $this->db->where('actividad_idactividad', $parent);
            $this->db->order_by('idevidencia', 'DESC');
            $query = $this->db->get($this->tabla)->row();
            $state = 'pendiente';
            if ($query) {
                $this->campos = (array) $query;
                $state = $query->estado;
                
            }
            return $state;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function Evidencies($parent)
    {
        $this->db->where('actividad_idactividad', $parent);
        $query = $this->db->get($this->tabla);
        return $query->result();
    }
}