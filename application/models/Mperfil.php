<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mperfil extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'perfil';
        parent::__construct($datos);
    }

    public function ModulosPerfil()
    {
        try {
            $query = $this->db->select("m.idmodulo")
                ->from("permiso p")
                ->join("modulo m", "m.idmodulo = p.modulo_idmodulo", "inner")
                ->where("p.perfil_idperfil", $this->id)
                ->where('m.estado', 'activo')
                ->order_by('m.orden', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }
}