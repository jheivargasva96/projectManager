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
		$data['empresa'] = 'Colegio Veracruz';
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

	public function ForgotPassword()
	{
		if ($this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		// Nombre de la vista
		$data['name'] = 'RECUPERAR COTRASEÑA';
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
			'js/forgotPassword.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('ForgotPassword');
		$this->load->view('pages/script.php');
	}

	public function SendRecovery()
	{
		$data = $this->Musuario->getWithCorreo($_POST['email']);
		if ($data['success'] == true) {
			$this->load->library('email');
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.googlemail.com',
				'smtp_user' => 'khriiiz.kano@gmail.com',
				'smtp_pass' => 'allisonkano21',
				'smtp_port' => '465',
				'smtp_crypto' => 'ssl',
				'mailtype' => 'html',
				'wordwrap' => TRUE,
				'charset' => 'utf-8',
				'newline' => "\r\n"
			);
			$this->email->initialize($config);

			$password = hash('sha256', $this->Musuario->get('identificacion'));
			$this->Musuario->set('password', $password);
			$numero = random_int(1, 100000);
			$this->Musuario->set('token', hash('sha256', $numero));
			$this->Musuario->guardar();
			
			$mensaje = "Cordial saludo señor " . $data['info']->nombres . " " . $data['info']->apellidos . ".<br><br>A través del siguiente link puede restablecer su contraseña<br><br><a href='" . base_url() . "Clogin/recovery?id=" . $data['info']->idusuario . "&num=" . $numero . "'>Restablecer mi contraseña<a>";
			$this->email->from('projectmanager@projectmanager.com', 'Project Manager');
			$this->email->to($data['info']->correo);
			$this->email->subject('Restablecimiento de contraseña');
			$this->email->message($mensaje);
			$this->email->send();

			$data['message'] = 'A su correo electrónico fue enviado un link para el restablecimiento de su contraseña';
			unset($data['info']);
		}

		if ($this->input->is_ajax_request()) {
			echo json_encode($data);
		}
	}

	public function recovery()
	{
		if ($this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		// Nombre de la vista
		$data['name'] = 'RECUPERAR COTRASEÑA';
		// Datos de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';
		$data['num'] = $_GET['num'];
		$data['idusuario'] = $_GET['id'];
		// Estilos css de la vista
		$data['css'] = array(
			'js/alertifyjs/css/alertify.rtl.css',
			'css/Login.css'
		);
		// Librerias js de la vista
		$data['js'] = array(
			'js/alertifyjs/alertify.js',
			'js/recovery.js'
		);
		
		$this->load->view('pages/head', $data);
		$this->load->view('Recovery');
		$this->load->view('pages/script.php');
	}

	public function saveNewPassword()
	{
		$data = array('success' => false, 'message' => 'Error inesperado, comuniquese con su administrador!');
		$usuario = new $this->Musuario();
		$usuario->consultar($_POST['idusuario']);

		if ($usuario->get('token') == hash('sha256', $_POST['token'])) {
			$usuario->set('password', hash('sha256', $_POST['nueva']));
			$usuario->set('token', '');
			$dataSave = $usuario->guardar();
			if ($dataSave['success'] == true) {
				$data['success'] = true;
				$data['message'] = 'La contraseña se actualizo correctamente';
			}
		} else {
			$data['message'] = 'Esta ingresando desde una url no valida, no es posible restablecer su contraseña';
		}

		if ($this->input->is_ajax_request()) {
			echo json_encode($data);
		}
	}
}
