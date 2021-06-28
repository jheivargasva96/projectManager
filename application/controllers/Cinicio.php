<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cinicio extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Musuario');
    }

    public function index()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Clogin');
        }
        
        $data = array();
        // Nombre de la Página actual
		$data['modulo'] = 'inicio';
        $data['name'] = 'GRAFICO PROGRAMAS';
        // Datos de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

        // Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener al clase active
		$data['ruta'] = '<li class="breadcrumb-item active"><a href="' . base_url() . '/Cinicio">Inicio</a></li>';

		$data['css'] = array(
            'js/alertifyjs/css/alertify.rtl.css',
            'chart.js/Chart.css',
			'chart.js/Chart.min.css'
        );

        $data['js'] = array(
            'bootstrap/js/bootstrap.bundle.min.js',
            'overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'js/adminlte.js',
            'js/alertifyjs/alertify.js',
            'chart.js/Chart.min.js',
            'js/inicio.js'
        );

        $this->load->view('pages/head', $data);
        $this->load->view('pages/header');
        $this->load->view('pages/menu');
        $this->load->view('pages/wrapper');
        $this->load->view('Inicio');
        $this->load->view('pages/footer');
        $this->load->view('pages/script');
    }

    public function ModalPassword()
	{
		$this->load->view('ModalPassword');
	}
}
