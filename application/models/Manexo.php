<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manexo extends Model
{
    public function __construct($datos = array())
    {
        $this->tabla = 'anexo';
        parent::__construct($datos);
    }

    public function getAnexosForList($Annex)
    {
        try {
            $query = $this->db->select("*")
                ->from($this->tabla)
                ->where('idanexo IN (' . implode(',', $Annex) . ')')
                ->order_by('documento', 'ASC')
                ->get();
            return $query->result();
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function eliminarAnexo()
    {
        try {
            $this->db->where('idanexo', $this->id);
            $this->db->delete('anexo');
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function updateEvidenciaAnexo($Annex, $idevidencia)
    {
        $this->AnnexClean($Annex);
        $this->db->where('idanexo IN (' . $Annex . ')');
        $evidencia['evidencia_idevidencia'] = $idevidencia;
        $this->db->update($this->tabla, $evidencia);
    }

    public function AnnexClean($Annex)
    {
        try {
            $this->db->where('idanexo NOT IN (' . $Annex . ')');
            $this->db->where('evidencia_idevidencia', 0);
            $this->db->delete('anexo');
            return true;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function getAnexosEvidence($parent)
    {
        $this->db->where('evidencia_idevidencia', $parent);
        $query = $this->db->get($this->tabla);
        return $query->result();
    }
}
