<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cperfil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Modelos Usados
		$this->load->model('Mperfil');
		$this->load->model('Mmodulo');
		$this->load->model('Mpermiso');
	}

	public function index()
	{
		if (!$this->session->userdata('idusuario')) {
			redirect('Clogin');
		}

		$data = array();
		// Nombre de la Página actual
		$data['modulo'] = 'modulo_perfil';
		$data['name'] = 'PERFILES';
		// data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

		// Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cperfil">Perfiles</a></li>';

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
			'bs-custom-file-input/bs-custom-file-input.min.js',
			'js/adminlte.js',
			'js/demo.js',
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
			'js/perfil/perfil.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('perfil/perfil');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
	}

	public function consultarTodos()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mperfil->consultarTodos());
		}
	}

	public function Modal()
	{
		$this->load->view('perfil/ModalPerfil');
	}

	public function ModalPermisos()
	{
		$this->load->view('perfil/ModalPermisos');
	}

	public function Modulos()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mmodulo->consultarActivos());
		}
	}

	public function ModulosPerfil()
	{
		$id  = $_POST['idperfil'];
		$perfil = new $this->Mperfil();
		$perfil->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($perfil->ModulosPerfil());
		}
	}

	public function Estado()
	{
		$id = $_POST['id'];
		$estado = $_POST['estado'];
		$this->Mperfil->consultar($id);
		$this->Mperfil->set('estado', $estado);
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mperfil->guardar());
		}
	}

	public function consultar()
	{
		$id  = $_POST['id'];
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mperfil->consultar($id));
		}
	}

	public function guardar()
	{
		$id  = $_POST['idperfil'];
		unset($_POST['idperfil']);
		$perfil = new $this->Mperfil($_POST);
		$perfil->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($perfil->guardar());
		}
	}

	public function guardarPermisos()
	{
		$this->Mpermiso->eliminarPermisos($_POST['perfil_idperfil'], $_POST['modulo']);
		$cant = count($_POST['modulo']);
		for ($i = 0; $i < $cant; $i++) {
			$this->Mpermiso->saveNew($_POST['perfil_idperfil'], $_POST['modulo'][$i]);
		}
		$data = array('success' => '1');

		echo json_encode($data);
	}
}
