<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clogin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Musuario');
	}

	public function index()
	{
		if ($this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		// Nombre de la vista
		$data['name'] = 'LOGIN';
		// Datos de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';
		// Estilos css de la vista
		$data['css'] = array(
			'js/alertifyjs/css/alertify.rtl.css',
			'css/Login.css'
		);
		// Librerias js de la vista
		$data['js'] = array(
			'js/alertifyjs/alertify.js',
			'js/login.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('Login');
		$this->load->view('pages/script.php');
	}

	public function Autenticar()
	{
		
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$data = $this->Musuario->login($email, $pass);

		if ($data['exito']) {
			$this->session->set_userdata('idusuario', $data['id']);
			$this->session->set_userdata('nombre', $data['nombre']);
			$this->session->set_userdata('idperfil', $data['idperfil']);
			$this->session->set_userdata('perfil', $data['perfil']);
			if (@$data['imagen']) {
				$this->session->set_userdata('imagen', $data['imagen']);
			} else {
				$this->session->set_userdata('imagen', 'assets/img/icono.jpg');
			}
		}

		if ($this->input->is_ajax_request()) {
			echo json_encode($data);
		}
	}

	public function Cerrar()
	{
		$this->session->sess_destroy();
		redirect('Clogin');
	}
}