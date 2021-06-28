<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Creportes extends CI_Controller
{

    public function getCountProjects()
    {
        $idprogram = $_POST['idprograma'];
        $this->load->model('Mproyecto');
        if ($_POST['estado'] != '') {
            $data['amount'] = $this->Mproyecto->CountState($_POST['estado'], $idprogram);
        } else {
            $data['amount'] = $this->Mproyecto->CountParent($idprogram);
        }
        if ($this->input->is_ajax_request()) {
			echo json_encode($data);
		}
    }
}