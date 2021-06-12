<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mpermiso extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'permiso';
        parent::__construct($datos);
    }

    public function consultarModulos()
    {
        try {
            $query = $this->db->select("m.nombre, m.etiqueta, m.controlador, m.icono")
                ->from($this->tabla . " p")
                ->join("modulo m", "m.idmodulo = p.modulo_idmodulo", "inner")
                ->where("p.perfil_idperfil", $this->session->userdata('idperfil'))
                ->where('m.estado', 'activo')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
