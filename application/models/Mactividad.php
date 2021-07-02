<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mactividad extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'actividad';
        parent::__construct($datos);
    }

    public function consultarInscribir($id)
    {
        try {
            $query = $this->db->select("ac.*")
                ->from($this->tabla . " ac")
                ->join("participante p", "ac.idactividad = p.actividad_idactividad AND p.usuario_idusuario = " . $id, "left")
				->where('idparticipante IS NULL')
                ->order_by('ac.nombre', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function consultarParticipante($id)
    {
        try {
            $query = $this->db->select("ac.*")
                ->from($this->tabla . " ac")
                ->join("participante p", "ac.idactividad = p.actividad_idactividad AND p.usuario_idusuario = " . $id, "inner")
                ->order_by('ac.nombre', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }

	public function CountState($state, $parentId)
    {
        $this->db->select('count(*) as cant');
        $this->db->from($this->tabla);
        $this->db->where('estado', $state);
        $this->db->where('indicador_idindicador', $parentId);
        $query = $this->db->get()->row();
        return $query->cant;
    }

    public function CountParent($parentId)
    {
        $this->db->select('count(*) as cant');
        $this->db->from($this->tabla);
        $this->db->where('indicador_idindicador', $parentId);
        $query = $this->db->get()->row();
        return $query->cant;
    }

}