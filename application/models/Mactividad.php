<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mactividad extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'actividad';
        parent::__construct($datos);
    }


    public function consultarParticipante($id)
    {
        try {
            $query = $this->db->select("ac.idactividad,ac.descripcion,ac.nombre,ac.fecha,ac.lugar,ac.indicador_idindicador,p.usuario_idusuario,ac.responsable")
                ->from($this->tabla . " ac")
                ->join("indicador i", "ac.indicador_idindicador = i.idindicador", "left")
                ->join("(select * from participante where usuario_idusuario = $id) p", "idactividad = p.actividad_idactividad", "left")
                ->where('idparticipante is  null')
                ->where('i.estado', 'activo')
                ->order_by('ac.nombre', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }
}