<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model extends CI_Model
{

    protected $tabla;
    protected $campos = array();
    protected $id;

    function __construct($datos = array())
    {
        parent::__construct();
        $this->id = 0;
        $this->campos = $datos;
    }

    public function guardar()
    {
        $dato = array('success' => 0, 'message' => 'Error inesperado!');
        if ($this->id == 0) {
            try {
                $this->db->insert($this->tabla, $this->campos);
                $this->id = $this->db->insert_id();
                $dato['message'] = $this->db->insert_id();
                $dato['success'] = true;
            } catch (\Throwable $th) {
                $dato['message'] = $th;
            }
        } else {
            try {
                $this->db->where('id' . $this->tabla, $this->id);
                $this->db->update($this->tabla, $this->campos);
                $dato['message'] = 'Dato actualizado!';
                $dato['success'] = true;
            } catch (\Throwable $th) {
                $dato['message'] = $th;
            }
        }

        return $dato;
    }

    public function consultarTodos()
    {
        $query = $this->db->get($this->tabla);
        return $query->result();
    }

    public function consultar($id)
    {
        $this->id = $id;
        try {
            $this->db->where('id' . $this->tabla, $id);
            $query = $this->db->get($this->tabla)->row();
            $this->campos = (array) $query;
            return $this->campos;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function consultarActivos()
    {
        try {
            $this->db->where('estado', 'activo');
            $query = $this->db->get($this->tabla);
            return $query->result();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function get($campo)
    {
        return $this->campos[$campo];
    }

    public function set($campo, $valor)
    {
        $this->campos[$campo] = $valor;
    }

    public function contar()
    {
        $this->db->select('count(*) as cant');
        $this->db->from($this->tabla);
        $query = $this->db->get()->row();
        return $query->cant;
    }

    public function setId($value)
    {
        $this->id = $value;
    }
}
