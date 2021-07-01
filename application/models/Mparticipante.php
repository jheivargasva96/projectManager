<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mparticipante extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'participante';
        parent::__construct($datos);
    }

    public function delete($id)
    {
        $dato = array('success' => 0, 'message' => 'Error inesperado!');
        try {
            $this->db->where('actividad_idactividad', $id);
            $this->db->where('usuario_idusuario', $this->session->userdata('idusuario'));
            $this->db->delete($this->tabla);
            $dato['message'] = 'Dato actualizado!';
            $dato['success'] = true;
        } catch (\Throwable $th) {
            $dato['message'] = $th;
        }
        return $dato;
    }

    public function deleteParticipante($id)
    {
        $dato = array('success' => 0, 'message' => 'Error inesperado!');
        try {
            $this->db->where('idparticipante', $id);
            $this->db->delete($this->tabla);
            $dato['message'] = 'Dato actualizado!';
            $dato['success'] = true;
        } catch (\Throwable $th) {
            $dato['message'] = $th;
        }
        return $dato;
    }

    public function obtenerInscritos($id)
	{
		try {
			$query = $this->db->select("p.idparticipante,p.actividad_idactividad,u.nombres,u.apellidos,p.estado")
				->from($this->tabla . " p")
				->join("usuario u", "p.usuario_idusuario = u.idusuario", "left")
                ->where('p.actividad_idactividad', $id)
				->get();
			return $query->result();
		} catch (\Throwable $th) {
			return $th;
		}
	}
}