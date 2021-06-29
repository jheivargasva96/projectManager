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
            $this->campos = (array) $query;
            return $query->estado;
        } catch (\Throwable $th) {
            return false;
        }
    }
}