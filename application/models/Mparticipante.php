<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mparticipante extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'participante';
        parent::__construct($datos);
    }


    public function delete()
    {
        $dato = array('success' => 0, 'message' => 'Error inesperado!');
        $id  = $_POST['id'];
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
}