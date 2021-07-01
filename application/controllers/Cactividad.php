<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cactividad extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//Modelos Usados
		$this->load->model('Musuario');
		$this->load->model('Mindicador');
		$this->load->model('Mactividad');
		$this->load->model('Mparticipante');
		$this->load->model('Mevidencia');
	}

	public function index()
	{
		if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		// Nombre de la Página actual
		$data['modulo'] = 'modulo_lista_actividades';
		$data['name'] = 'Actividades';
		// data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

		// Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cactividad">Actividades</a></li>';

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
			'js/actividad/actividad.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('actividad/actividad');
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
		$data['modulo'] = 'modulo_mis_actividades';
		$data['name'] = 'Mis Actividades';
		// data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

		// Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cactividad/filtro_responsable">Mis Actividades</a></li>';

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
			'js/actividad/Misactividades.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('actividad/Misactividades');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
	}

	public function inscribirse()
	{
		if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		// Nombre de la Página actual
		$data['modulo'] = 'modulo_inscribir_actividades';
		$data['name'] = 'Inscribirse';
		// data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

		// Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cactividad/inscribirse">Inscribirse</a></li>';

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
			'js/actividad/inscribirse.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('actividad/Inscribirse');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
	}

	public function participando()
	{
		if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		// Nombre de la Página actual
		$data['modulo'] = 'modulo_actividades_participando';
		$data['name'] = 'Participando';
		// data de la empresa
		$data['empresa'] = 'PROJECT MANAGER';
		$data['logo'] = 'assets/img/icono.jpg';

		// Ruta de navegación actual - En caso de una ruta más larga se colocan mas objetos li, en el que estemos debe tener la clase active
		$data['ruta'] = '<li class="breadcrumb-item"><a href="' . base_url() . 'Cinicio">Inicio</a></li><li class="breadcrumb-item active"><a href="' . base_url() . 'Cactividad/participando">Participando</a></li>';

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
			'js/actividad/participando.js'
		);

		$this->load->view('pages/head', $data);
		$this->load->view('pages/header');
		$this->load->view('pages/menu');
		$this->load->view('pages/wrapper');
		$this->load->view('actividad/participando');
		$this->load->view('pages/footer');
		$this->load->view('pages/script');
	}

	public function consultarTodos()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->consultarTodos());
		}
	}

	public function consultarUsuarios()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Musuario->consultarActivos());
		}
	}

	public function consultarIndicador()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mindicador->consultarDisponible());
		}
	}

	public function consultarMisActividades()
	{
		$id = $this->session->userdata('idusuario');
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->consultarMis($id));
		}
	}

	public function consultarInscribir()
	{
		$id = $this->session->userdata('idusuario');
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->consultarInscribir($id));
		}
	}

	public function consultarParticipante()
	{
		$id = $this->session->userdata('idusuario');
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->consultarParticipante($id));
		}
	}

	public function Modal()
	{
		$this->load->view('actividad/Modalactividad');
	}

	public function Estado()
	{
		$id = $_POST['id'];
		$estado = $_POST['estado'];
		if ($estado == 'inactivo') {
			$this->Mactividad->consultar($id);
			$this->Mactividad->set('estado', $estado);
			if ($this->input->is_ajax_request()) {
				echo json_encode($this->Mactividad->guardar());
			}
		} else {
			$this->load->model('Mevidencia');
			$state = $this->Mevidencia->last($id);
			if ($this->input->is_ajax_request()) {
				echo json_encode($this->ValidarEstados($id, $state));
			}
		}
	}

	public function consultar()
	{
		$id  = $_POST['id'];
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->consultar($id));
		}
	}

	public function guardar()
	{
		$id  = $_POST['idactividad'];
		unset($_POST['idactividad']);
		$indicador = new $this->Mactividad($_POST);
		$indicador->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($indicador->guardar());
		}
	}

	public function guardarInscripcion()
	{
		$_POST['usuario_idusuario'] = $this->session->userdata('idusuario');
		$id  = $_POST['idparticipante'];
		unset($_POST['idparticipante']);
		$indicador = new $this->Mparticipante($_POST);
		$indicador->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($indicador->guardar());
		}
	}

	public function guardarAnexos()
	{
		// Datos de retorno
		$data = array('success' => 0, 'message' => 'Error inesperado!');
		// Procesamos los anexos enviados por el formulario
		if (isset($_FILES['Lista_Anexos'])) {
			if (preg_match('/#|"|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�/', $_FILES['Lista_Anexos']['name']) === 1) {
				return 3;
			}
		}

		if ($_FILES['Lista_Anexos']['size'] > 0) {
			// Definimos la ruta donde se va a guardar el archivo
			$route = $this->routeCreate();
			$name = 'anexoActividad_' . date('YmdHis') . random_int(1, 2000) . "_" . $_FILES['Lista_Anexos']['name'];
			// Configuramos la carga del anexo con codeigniter
			$config = array();
			$config['upload_path'] = $route;
			$config['allowed_types'] = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
			$config['max_size'] = '20048';
			$config['overwrite'] = false;
			$config['file_name'] = $name;

			// Cargamos las librerias necesarias
			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			// Se carga el archivo
			$this->upload->initialize($config);
			if ($this->upload->do_upload('Lista_Anexos')) {
				$data = $this->upload->data();
				$config['image_library'] = 'gd2';
				$config['source_image'] = $data['full_path'];
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 512;
				$config['height'] = 512;
				$this->image_lib->clear();
				$this->image_lib->initialize($config);
				$this->image_lib->resize();

				// Guardamos el registro en db
				$dataAnnex = array();
				$dataAnnex['evidencia_idevidencia'] = '';
				$dataAnnex['documento'] = $_FILES['Lista_Anexos']['name'];
				$dataAnnex['ruta'] = $route . '/' . str_replace(' ', '_', $name);
				$this->load->model('Manexo');
				$Annex = new $this->Manexo($dataAnnex);
				$data = $Annex->guardar();
			} else {
				$data['message'] = 'El anexo no pudo ser almacenado.';
			}
		}

		if ($this->input->is_ajax_request()) {
			echo json_encode($data);
		}
	}

	public function getAnexosForList()
	{
		$this->load->model('Manexo');
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Manexo->getAnexosForList($_POST['anexos']));
		}
	}

	private function routeCreate()
	{
		$route = FCPATH . 'uploads/anexoActividad';
		if (!file_exists($route)) {
			mkdir($route, 0777, true);
		}
		return $route;
	}

	public function obtenerAnexoActividad()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->obtenerAnexoActividad());
		}
	}

	public function eliminarAnexo()
	{
		$this->load->model('Manexo');
		$Annex = new $this->Manexo();
		$Annex->consultar($_POST['id']);
		// Eliminamos el archivo
		unlink($Annex->get('ruta'));
		if ($this->input->is_ajax_request()) {
			echo json_encode($Annex->eliminarAnexo());
		}
	}

	public function delete()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mparticipante->delete($_POST['id']));
		}
	}

	public function deleteParticipante()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mparticipante->deleteParticipante($_POST['id']));
		}
	}

	public function ValidarEstados($id, $state)
	{
		$today = date('Y-m-d');
		$activity = new $this->Mactividad();
		$activity->consultar($id);

		if ($state == 'terminado') {
			if ($today > $activity->get('fecha')) {
				$state = 'terminado con retraso';
			}
		} else if ($state == 'en proceso') {
			if ($today > $activity->get('fecha')) {
				$state = 'vencido';
			}
		}

		$activity->set('estado', $state);
		$data = $activity->guardar();
		$this->ValidarEstadosIndicador($activity->get('indicador_idindicador'));
		return $data;
	}

	public function ValidarEstadosIndicador($id)
	{
		$this->load->model('Mindicador');
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

	public function guardarEvidencia()
	{
		$this->load->model('Manexo');
		$Annex = $_POST['anexos'];
		unset($_POST['anexos']);
		$evidencia = new $this->Mevidencia($_POST);
		$data = $evidencia->guardar();
		$this->Manexo->updateEvidenciaAnexo($Annex, $data['message']);
		$this->ValidarEstados($evidencia->get('actividad_idactividad'), $evidencia->get('estado'));
		if ($this->input->is_ajax_request()) {
			echo json_encode($data);
		}
	}

	public function obtenerInscritos()
	{
		$id  = $_POST['id'];
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mparticipante->obtenerInscritos($id));
		}
	}

	public function EstadoAprobar()
	{
		$id = $_POST['id'];
		$estado = $_POST['estado'];
		$this->Mparticipante->consultar($id);
		$this->Mparticipante->set('estado', $estado);
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mparticipante->guardar());
		}
	}

	public function ModalEvidencia()
	{
		$this->load->view('actividad/ModalEvidencia');
	}

	public function ModalListaEvidencias()
	{
		$this->load->view('actividad/ListaEvidencias');
	}
}
