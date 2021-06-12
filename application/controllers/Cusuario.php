<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cusuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Modelos Usados
		$this->load->model('Musuario');
		$this->load->model('Mperfil');
		$this->load->model('Mtipo_identificacion');
	}

	public function index()
	{
		if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
        // Nombre de la Página actual
		$data['modulo'] = 'modulo_usuario';
        $data['name'] = 'USUARIOS';
        // data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

        // Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cusuario">Usuarios</a></li>';

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
            'js/menu.js',
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
			'js/Usuario/usuarios.js'
        );

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('usuario/Usuario');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
	}

	public function consultarTodos()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->consultarTodos());
		}
	}

	public function guardar()
	{
		$id  = $_POST['idusuario'];
		unset($_POST['idusuario']);
		if ($id == 0) {			
			$_POST['password'] = hash('sha256', $_POST['identificacion']);
		}
		$usuario = new $this->Musuario($_POST);
		$usuario->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($usuario->guardar());
		}
	}

	public function consultar()
	{
		$id  = $_POST['id'];
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->consultar($id));
		}
	}

	public function Estado()
	{
		$id = $_POST['id'];
		$estado = $_POST['estado'];
		$this->Musuario->consultar($id);
		$this->Musuario->set('estado', $estado);
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->guardar());
		}

	}

	public function ResetPassword()
	{
		$id = $_POST['id'];
		$this->Musuario->consultar($id);
		$password = hash('sha256', $this->Musuario->get('identificacion'));
		$this->Musuario->set('password', $password);
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->guardar());
		}
	}

	public function newPassword()
	{
		$id = $_POST['id'];
		$this->Musuario->consultar($id);
		$password = hash('sha256', $_POST['password']);
		$this->Musuario->set('password', $password);
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->guardar());
		}
	}

	public function Modal()
	{
		$this->load->view('usuario/ModalUsuario');
	}

	public function consultarPerfiles()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mperfil->consultarActivos());
		}
	}

	public function consultarTipoIdentificacion()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mtipo_identificacion->consultarActivos());
		}
	}
}
