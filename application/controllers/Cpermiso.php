<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cpermiso extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mpermiso');
    }

    public function Consultar()
    {
        if ($this->input->is_ajax_request()) {
            echo json_encode($this->Mpermiso->consultarModulos());
        }
    }
}