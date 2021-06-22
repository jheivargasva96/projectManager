<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mpermiso extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'permiso';
        parent::__construct($datos);
    }

    public function consultarModulosPrincipales()
    {
        try {
            $query = $this->db->select("m.nombre, m.etiqueta, m.controlador, m.icono, m.idmodulo")
                ->from($this->tabla . " p")
                ->join("modulo m", "m.idmodulo = p.modulo_idmodulo", "inner")
                ->where("p.perfil_idperfil", $this->session->userdata('idperfil'))
                ->where('m.cod_padre', 0)
                ->where('m.estado', 'activo')
                ->order_by('m.orden', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function consultarModulosSecundarios($cod_padre)
    {
        try {
            $query = $this->db->select("m.nombre, m.etiqueta, m.controlador, m.icono")
                ->from($this->tabla . " p")
                ->join("modulo m", "m.idmodulo = p.modulo_idmodulo", "inner")
                ->where("p.perfil_idperfil", $this->session->userdata('idperfil'))
                ->where('m.estado', 'activo')
                ->where('m.cod_padre', $cod_padre)
                ->order_by('m.orden', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function eliminarPermisos($idperfil, $modulos)
    {
        $dato = array('success' => 0, 'message' => 'Error inesperado!');
        try {
            $this->db->where('perfil_idperfil', $idperfil);
            $this->db->where_not_in('modulo_idmodulo', implode(',', $modulos));
            $dato['message'] = $this->db->delete($this->tabla);
            $dato['success'] = true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function saveNew($idperfil, $idmodulo)
    {
        $dato = array('success' => 0, 'message' => 'Permiso ya asignado!');
        try {
            $this->db->where('perfil_idperfil', $idperfil);
            $this->db->where('modulo_idmodulo', $idmodulo);
            $query = $this->db->get($this->tabla)->row();
            if (!$query) {
                $this->campos = array('perfil_idperfil' => $idperfil, 'modulo_idmodulo' => $idmodulo);
                $this->db->insert($this->tabla, $this->campos);
                $dato['message'] = $this->db->insert_id();
                $dato['success'] = true;
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
