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
}
