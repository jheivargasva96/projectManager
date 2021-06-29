<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mactividad extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'actividad';
        parent::__construct($datos);
    }


	public function consultarMisActividades($id)
	{
		try {
			$query = $this->db->select("ac.*,ev.idevidencia,ev.observaciones,ev.estado")
				->from($this->tabla . " ac")
				->join("evidencia ev", "ac.idactividad = ev.actividad_idactividad", "left")
				->where('ac.responsable', $id)
				->get();
			return $query->result();
		} catch (\Throwable $th) {
			return $th;
		}
	}



    public function consultarInscribir($id)
    {
        try {
            $query = $this->db->select("ac.idactividad,ac.descripcion,ac.nombre,ac.fecha,ac.lugar,ac.indicador_idindicador,p.usuario_idusuario,ac.responsable")
                ->from($this->tabla . " ac")
                ->join("indicador i", "ac.indicador_idindicador = i.idindicador", "left")
                ->join("(select * from participante where usuario_idusuario = $id) p", "idactividad = p.actividad_idactividad", "left")
                ->where('idparticipante is  null')
                ->where('i.estado', 'activo')
                ->order_by('ac.nombre', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function consultarParticipante($id)
    {
        try {
            $query = $this->db->select("p.idparticipante,ac.idactividad,ac.descripcion,ac.nombre,ac.fecha,ac.lugar,ac.indicador_idindicador,p.usuario_idusuario,ac.responsable")
                ->from($this->tabla . " ac")
                ->join("participante p", "p.actividad_idactividad = ac.idactividad", "left")
                ->join("indicador i", "ac.indicador_idindicador = i.idindicador", "left")
                ->join("usuario u", "ac.responsable = u.idusuario", "left")
                ->where('p.usuario_idusuario',$id)
                ->where('i.estado', 'activo')
                ->order_by('ac.nombre', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function uploadImg()
	{
		if (isset($_FILES['Lista_Anexos'])){
			if(preg_match('/#|"|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�|�/', $_FILES['Lista_Anexos']['name'])===1){
				return 3;
			}
		}
	
		$codigo    = $this->input->post('codigo');
		$files     = $_FILES;
		$nombreDoc = "";

	
		$cpt = count($_FILES['Lista_Anexos']['name']);
		$subidas = array();
		if($files['Lista_Anexos']['size'] > 0){
			// Configuraci�n upload
			$config = array();
			$config['upload_path']      = FCPATH.'/uploads/anexoActividad';

			$config['allowed_types']    = 'gif|jpg|png|pdf|xlsx|docx|xls|doc|txt|jpeg';
			$config['max_size']         = '20048';
			$config['overwrite']        = false;
			$this->load->library('upload');
			$this->load->library('image_lib');

			if (!file_exists($config['upload_path'])) {
				mkdir($config['upload_path'], 0777, true);
			}

			// Subida de cada archivo
			$_FILES['Lista_Anexos']['name']     = $files['Lista_Anexos']['name'];
			$_FILES['Lista_Anexos']['type']     = $files['Lista_Anexos']['type'];
			$_FILES['Lista_Anexos']['tmp_name'] = $files['Lista_Anexos']['tmp_name'];
			$_FILES['Lista_Anexos']['error']    = $files['Lista_Anexos']['error'];
			$_FILES['Lista_Anexos']['size']     = $files['Lista_Anexos']['size'];
			if (strpos($files['Lista_Anexos']['name'], " ") == true) {
				$nombreDoc = str_replace(' ','_',$files['Lista_Anexos']['name']); 
			}else{
				$nombreDoc = $files['Lista_Anexos']['name'];
			}
			$config['file_name'] = 'anexoActividad_'.$codigo."_".$nombreDoc;
			$this->upload->initialize($config);
			$this->db->trans_begin();
				$archivo = array(
					'evidencia_idevidencia' => $codigo,
					'documento' => $nombreDoc,
					'ruta'      => './uploads/anexoActividad/anexoActividad_'.$codigo."_".$nombreDoc
				);
				
				$this->db->insert('anexo', $archivo);
				$insert_id = $this->db->insert_id();
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$subida = array();
				$subida['nombre'] = $_FILES['Lista_Anexos']['name'];
				if ($this->upload->do_upload('Lista_Anexos')) {
					$data = $this->upload->data();
					// Resize
					$config['image_library'] = 'gd2';
					$config['source_image'] = $data['full_path'];
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 512;
					$config['height'] = 512;
					$this->image_lib->clear();
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->db->trans_commit();
					$subida['estado'] = 1;
				} else {
					$this->db->trans_rollback();
					$subida['estado'] = 0;
				}
				array_push($subidas, $subida);
			}
		}else{
			return 0;
		}
		return $subidas;
	}

	public function obtenerAnexoActividad()
    {
		$id  = $_POST['id'];
        try {
            $query = $this->db->select("idanexo,evidencia_idevidencia,documento,ruta")
                ->from('anexo')
                ->where('evidencia_idevidencia', $id)
                ->order_by('documento', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }

	public function eliminarAnexo()
	{
		$codigo = $this->input->post('id');
		$ruta = $this->db->query("SELECT ruta FROM anexo WHERE idanexo = $codigo")->result();
		$this->db->trans_begin();

		$this->db->where('idanexo',$codigo);
		$this->db->delete('anexo');

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return 0;
		}else{
			$this->db->trans_commit();
			for ($i=0; $i < count($ruta) ; $i++) {
				if (is_file($ruta[$i]->ruta)) {
					unlink($ruta[$i]->ruta);
				}
			}
			return 1;
		}
	}

	public function CountState($state, $parentId)
    {
        $this->db->select('count(*) as cant');
        $this->db->from($this->tabla);
        $this->db->where('estado', $state);
        $this->db->where('indicador_idindicador', $parentId);
        $query = $this->db->get()->row();
        return $query->cant;
    }

    public function CountParent($parentId)
    {
        $this->db->select('count(*) as cant');
        $this->db->from($this->tabla);
        $this->db->where('indicador_idindicador', $parentId);
        $query = $this->db->get()->row();
        return $query->cant;
    }
}