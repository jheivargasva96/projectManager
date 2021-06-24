<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cproyecto extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		//Modelos Usados
		$this->load->model('Mproyecto');
        $this->load->model('Musuario');
		$this->load->model('Mprograma');
	}

    public function index()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
        // Nombre de la Página actual
		$data['modulo'] = 'modulo_proyecto';
        $data['name'] = 'Proyectos';
        // data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

        // Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cproyecto">Proyectos</a></li>';

		$data['css'] = array(
            'js/alertifyjs/css/alertify.rtl.css',
			'js/alertifyjs/css/themes/default.rtl.css',
			'datatables-bs4/css/dataTables.bootstrap4.min.css',
			'datatables-responsive/css/responsive.bootstrap4.min.css',
			'datatables-buttons/css/buttons.bootstrap4.min.css'
        );

        $data['js'] = array(
            'bootstrap/js/bootstrap.bundle.min.js',
            'overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'js/adminlte.js',
            'js/alertifyjs/alertify.js',
			'datatables/jquery.dataTables.min.js',
			'datatables-bs4/js/dataTables.bootstrap4.min.js',
			'datatables-responsive/js/dataTables.responsive.min.js',
			'datatables-responsive/js/responsive.bootstrap4.min.js',
			'datatables-buttons/js/dataTables.buttons.min.js',
			'datatables-buttons/js/buttons.bootstrap4.min.js',
			'jszip/jszip.min.js',
			'pdfmake/pdfmake.min.js',
			'pdfmake/vfs_fonts.js',
			'datatables-buttons/js/buttons.html5.min.js',
			'datatables-buttons/js/buttons.print.min.js',
			'datatables-buttons/js/buttons.colVis.min.js',
			'js/proyecto/proyecto.js'
        );

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('proyecto/proyecto');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
    }

	public function filtro_responsable()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
        // Nombre de la Página actual
		$data['modulo'] = 'modulo_proyecto';
        $data['name'] = 'Proyectos';
        // data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

        // Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cproyecto">Proyectos</a></li>';

		$data['css'] = array(
            'js/alertifyjs/css/alertify.rtl.css',
			'js/alertifyjs/css/themes/default.rtl.css',
			'datatables-bs4/css/dataTables.bootstrap4.min.css',
			'datatables-responsive/css/responsive.bootstrap4.min.css',
			'datatables-buttons/css/buttons.bootstrap4.min.css'
        );

        $data['js'] = array(
            'bootstrap/js/bootstrap.bundle.min.js',
            'overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'js/adminlte.js',
            'js/alertifyjs/alertify.js',
			'datatables/jquery.dataTables.min.js',
			'datatables-bs4/js/dataTables.bootstrap4.min.js',
			'datatables-responsive/js/dataTables.responsive.min.js',
			'datatables-responsive/js/responsive.bootstrap4.min.js',
			'datatables-buttons/js/dataTables.buttons.min.js',
			'datatables-buttons/js/buttons.bootstrap4.min.js',
			'jszip/jszip.min.js',
			'pdfmake/pdfmake.min.js',
			'pdfmake/vfs_fonts.js',
			'datatables-buttons/js/buttons.html5.min.js',
			'datatables-buttons/js/buttons.print.min.js',
			'datatables-buttons/js/buttons.colVis.min.js',
			'js/proyecto/Misproyectos.js'
        );

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('proyecto/Misproyectos');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
    }

	public function reporte()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
        // Nombre de la Página actual
		$data['modulo'] = 'modulo_reporte_proyectos';
        $data['name'] = ' Reporte Proyectos';
        // data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

        // Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cproyecto">Reporte</a></li>';

		$data['css'] = array(
			'chart.js/Chart.css',
			'chart.js/Chart.min.css',
            'js/alertifyjs/css/alertify.rtl.css',
			'js/alertifyjs/css/themes/default.rtl.css'
        );

        $data['js'] = array(
			'bootstrap/js/bootstrap.bundle.min.js',
			'js/demo.js',
			'js/adminlte.min.js',
			'js/alertifyjs/alertify.js',
			'chart.js/Chart.min.js',
			'js/proyecto/Barrasproyecto.js',
        );

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('proyecto/Barrasproyecto');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
    }




    public function consultarTodos()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mproyecto->consultarTodos());
		}
	}
	
	public function consultarMisProyectos()
	{
		$id = $this->session->userdata('idusuario');
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mproyecto->consultarMis($id));
		}
	}

    public function consultarUsuarios()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->consultarActivos());
		}
	}

	public function consultarPro()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mprograma->consultarActivos());
		}
	}
	

    public function Modal()
	{
		$this->load->view('proyecto/ModalProyecto');
	}


    public function Estado()
	{
		$id = $_POST['id'];
		$estado = $_POST['estado'];
		$this->Mproyecto->consultar($id);
		$this->Mproyecto->set('estado', $estado);
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mproyecto->guardar());
		}

	}

    public function consultar()
	{
		$id  = $_POST['id'];
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mproyecto->consultar($id));
		}
	}

    public function guardar()
	{
		$id  = $_POST['idproyecto'];
		unset($_POST['idproyecto']);
		$proyecto = new $this->Mproyecto($_POST);
		$proyecto->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($proyecto->guardar());
		}
	}
}
