<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Musuario extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'usuario';
        parent::__construct($datos);
        $this->load->model('Mperfil');
    }

    public function login($email, $password)
    {
        $datos = array('exito' => 0, 'perfil' => '', 'nombre' => '', 'id' => '', 'mensaje' => 'Error Inesperado');
        try {
            $this->db->where('estado', 'activo');
            $this->db->where('correo', $email);
            $this->db->where('password', hash('sha256', $password));
            // $this->db->where('password', $password);
            $query = $this->db->get($this->tabla)->row();
            if ($query) {
                $datos['exito'] = true;
                $datos['idperfil'] = $query->perfil_idperfil;
                $datos['id'] = $query->idusuario;
                $datos['nombre'] = $query->nombres . ' ' . $query->apellidos;
                $this->Mperfil->consultar($query->perfil_idperfil);
                $datos['perfil'] = $this->Mperfil->get('nombre');
                $datos['mensaje'] = 'Bienvenido ' . $datos['nombre'];
            } else {
                $datos['mensaje'] = 'Usuario o contraseña incorrectos';
            }
            return $datos;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getWithCorreo($email)
    {
        $data = array('success' => false, 'message' => 'Error inesperado!');
        try {
            $this->db->where('estado', 'activo');
            $this->db->where('correo', $email);
            $query = $this->db->get($this->tabla)->row();
            if ($query) {
                $data['success'] = true;
                $data['message'] = 'Funcionario encontrado';
                $data['info'] = $query;
                $this->id = $query->idusuario;
                $this->campos = (array) $query;
            } else {
                $data['message'] = 'El usuario no se ha encontrado';
            }
            return $data;
        } catch (\Throwable $th) {
            return $th;
        }
        
    }
}
