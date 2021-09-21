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

		$data['content_page'] = 'actividad/actividad';
		// $contenido['titulo'] = "Listado Vencimientos Tiempo";

        // Nombre de la Página actual
		$data['modulo'] = 'modulo_lista_actividades';
        $data['name'] = 'Actividades';
        // data de la empresa
		$data['empresa'] = 'Colegio Veracruz';
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
		$this->load->view('pages/gestion_view', $data);
    }

	public function filtro_responsable()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		$data['content_page'] = 'actividad/Misactividades';
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

		$this->load->view('pages/gestion_view', $data);
    }

	public function inscribirse()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
		$data['content_page'] = 'actividad/Inscribirse';
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

		$this->load->view('pages/gestion_view', $data);
    }

	public function participando()
    {
        if (!$this->session->userdata('idusuario')) {
			redirect('Cinicio');
		}

		$data = array();
        // Nombre de la Página actual
		$data['content_page'] = 'actividad/participando';
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
		$this->load->view('pages/gestion_view', $data);
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
			echo json_encode($this->Mactividad->consultarMisActividades($id));
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

	public function guardarIncripcion()
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

	public function guardarAnexosVehiculo()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->uploadImg());
		}
	}

	public function obtenerAnexoActividad()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->obtenerAnexoActividad());
		}
	}
	
	public function eliminarAnexo()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mactividad->eliminarAnexo());
		}
	}

	public function delete()
	{
		if ($this->input->is_ajax_request()) {
			echo json_encode($this->Mparticipante->delete());
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
		$this->load->library('Cindicador');
		$this->Cindicador->ValidarEstados($activity->get('indicador_idindicador'));
		return $data;
	}

	

	public function guardarEvidencia()
	{
		$id  = $_POST['idevidencia'];
		$_POST['fecha'] = date("Y-m-d");
		unset($_POST['idevidencia']);
		$evidencia = new $this->Mevidencia($_POST);
		$evidencia->setId($id);
		if ($this->input->is_ajax_request()) {
			echo json_encode($evidencia->guardar());
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

}
