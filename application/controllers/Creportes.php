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

    public function getCountIndicator()
    {
        $idproyecto = $_POST['idproyecto'];
        $this->load->model('Mindicador');
        if ($_POST['estado'] != '') {
            $data['amount'] = $this->Mindicador->CountState($_POST['estado'], $idproyecto);
        } else {
            $data['amount'] = $this->Mindicador->CountParent($idproyecto);
        }
        if ($this->input->is_ajax_request()) {
			echo json_encode($data);
		}
    }

    public function getCountActivity()
    {
        $idindicador = $_POST['idindicador'];
        $this->load->model('Mactividad');
        if ($_POST['estado'] != '') {
            $data['amount'] = $this->Mactividad->CountState($_POST['estado'], $idindicador);
        } else {
            $data['amount'] = $this->Mactividad->CountParent($idindicador);
        }
        if ($this->input->is_ajax_request()) {
			echo json_encode($data);
		}
    }

    public function getCumplimiento()
    {
        $this->load->model('Mproyecto');
        if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mproyecto->consultarCumplimiento());
		}
    }
}