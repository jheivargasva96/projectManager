<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cpermiso extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mpermiso');
    }

    public function consultarModulosPrincipales()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->Mpermiso->consultarModulosPrincipales());
        }
    }

    public function consultarModulosSecundarios()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->Mpermiso->consultarModulosSecundarios($_POST['cod_padre']));
        }
    }
}