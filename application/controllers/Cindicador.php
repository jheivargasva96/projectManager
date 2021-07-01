<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cindicador extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Modelos Usados
		$this->load->model('Mindicador');
		$this->load->model('Musuario');
		$this->load->model('Mproyecto');
		$this->load->model('Mactividad');
	}

	public function index()
	{
		if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		// Nombre de la Página actual
		$data['modulo'] = 'modulo_lista_indicadores';
		$data['name'] = 'Indicadores';
		// data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
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
			'js/indicador/indicador.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('indicador/indicador');
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
		$data['modulo'] = 'modulo_mis_indicadores';
		$data['name'] = 'Indicadores';
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
			'js/indicador/Misindicadores.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('indicador/Misindicadores');
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
		$data['modulo'] = 'modulo_reporte_indicadores';
		$data['name'] = ' Reporte indicadores';
		// data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

		// Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cindicador">Reporte</a></li>';

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
			'js/indicador/Barrasindicador.js',
			'js/indicador/Stackedindicador.js',
		);

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('indicador/Barrasindicador');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
	}

	public function getCumplimiento()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mindicador->consultarCumplimiento());
		}
	}

	public function consultarPro()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mproyecto->consultarDisponible());
		}
	}

	public function consultarTodos()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mindicador->consultarTodos());
		}
	}

	public function consultarIndicadores()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mindicador->consultarTodos());
		}
	}

	public function consultarUsuarios()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->consultarActivos());
		}
	}

	public function consultarMisIndicadores()
	{
		$id = $this->session->userdata('idusuario');
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mindicador->consultarMis($id));
		}
	}

	public function Modal()
	{
		$this->load->view('indicador/Modalindicador');
	}

	public function Estado()
	{
		$id = $_POST['id'];
		$estado = $_POST['estado'];
		if ($estado == 'inactivo') {
			$this->Mindicador->consultar($id);
			$this->Mindicador->set('estado', $estado);
			if ($this->input->is_ajax_request()) {
				echo json_encode($this->Mindicador->guardar());
			}
		} else {
			if ($this->input->is_ajax_request()) {
				echo json_encode($this->ValidarEstados($id));
			}
		}
	}

	public function consultar()
	{
		$id  = $_POST['id'];
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mindicador->consultar($id));
		}
	}

	public function guardar()
	{
		$id  = $_POST['idindicador'];
		unset($_POST['idindicador']);
		$indicador = new $this->Mindicador($_POST);
		$indicador->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($indicador->guardar());
		}
	}

	public function ValidarEstados($id)
	{
		$indicator = new $this->Mindicador();
		$indicator->consultar($id);

		$activitiesNumber = $this->Mactividad->CountParent($id);
		$finishedActivities = $this->Mactividad->CountParent('terminado', $id);

		$state = 'pendiente';
		$percentage = 0;
		// Si no tiene hijos asignados pendiente porque nunca se inicio, y su cumplimiento sera 0
		if ($activitiesNumber > 0) {
			if ($activitiesNumber == $finishedActivities) {
				$state = 'terminado';
			} elseif ($finishedActivities < $activitiesNumber) {
				$state = 'en proceso';
			}
			$percentage = $finishedActivities * 100 / $activitiesNumber;
		}
		
		$indicator->set('estado', $state);
		$indicator->set('cumplimiento', $percentage);
		$data = $indicator->guardar();
		// Actualizar el estado del proyecto
		$this->ValidarEstadosProyecto($indicator->get('proyecto_idproyecto'));
		return $data;
	}

	public function ValidarEstadosProyecto($id)
	{
		$this->load->model('Mproyecto');
		$today = date('Y-m-d');
		$project = new $this->Mproyecto();
		$project->consultar($id);
		
		$indicatorsNumber = $this->Mindicador->CountParent($id);
		$finishedIndicators = $this->Mindicador->CountParent('terminado', $id);

		$state = 'pendiente';
		$percentage = 0;

		// Si no tiene hijos asignados pendiente porque nunca se inicio, y su cumplimiento sera 0
		if ($indicatorsNumber > 0) {
			if ($indicatorsNumber == $finishedIndicators) {
				if ($today <= $project->get('fecha_fin')) {
					$state = 'terminado';
				} else {
					$state = 'terminado con retraso';
				}
			} else if ($finishedIndicators < $indicatorsNumber) {
				if ($today <= $project->get('fecha_fin')) {
					$state = 'en proceso';
				} else {
					$state = 'vencido';
				}
			}
			$percentage = $finishedIndicators * 100 / $indicatorsNumber;
		}		
		$project->set('estado', $state);
		$project->set('cumplimiento', $percentage);
		return $project->guardar();
	} 
}
