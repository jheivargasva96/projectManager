<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cprograma extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		//Modelos Usados
		$this->load->model('Mprograma');
        $this->load->model('Musuario');
	}

    public function index()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		$data['content_page'] = 'programa/programa';
        // Nombre de la Página actual
		$data['modulo'] = 'modulo_lista_programas';
        $data['name'] = 'PROGRAMAS';
        // data de la empresa
		$data['empresa'] = 'Colegio Veracruz';
		$data['logo'] = 'assets/img/icono.jpg';

        // Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cprograma">Programas</a></li>';

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
			'js/programa/programa.js'
        );

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('programa/programa');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
    }

    public function consultarTodos()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mprograma->consultarTodos());
		}
	}

    public function consultarUsuarios()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->consultarActivos());
		}
	}

    public function Modal()
	{
		$this->load->view('programa/ModalPrograma');
	}

    public function Estado()
	{
		$id = $_POST['id'];
		$estado = $_POST['estado'];
		$this->Mprograma->consultar($id);
		$this->Mprograma->set('estado', $estado);
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mprograma->guardar());
		}

	}

    public function consultar()
	{
		$id  = $_POST['id'];
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mprograma->consultar($id));
		}
	}

    public function guardar()
	{
		$id  = $_POST['idprograma'];
		unset($_POST['idprograma']);
		$programa = new $this->Mprograma($_POST);
		$programa->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($programa->guardar());
		}
	}

	public function filtro_responsable()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
        // Nombre de la Página actual
		$data['modulo'] = 'modulo_mis_programas';
        $data['name'] = 'MIS PROGRAMAS';
        // data de la empresa
		$data['empresa'] = 'Colegio Veracruz';
		$data['logo'] = 'assets/img/icono.jpg';

        // Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cprograma/filtro_responsable">Mis Programas</a></li>';

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
			'js/programa/misProgramas.js'
        );

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('programa/MisProgramas');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
    }

	public function Mios()
	{
		$id = $this->session->userdata('idusuario');
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mprograma->consultarMis($id));
		}
	}

	public function getActive()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mprograma->consultarActivos());
		}
	}
}
