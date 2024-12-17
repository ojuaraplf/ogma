<?php

	class DetalheChamado_model extends CI_Model {
		public function fetchChamado($CHD_Codigo)
		{
			$this->db->select('*');
			$this->db->where('CHD_Codigo', $CHD_Codigo);
			$query = $this->db->get('ogm_vw_chamadodetalhes');
			if ($query->num_rows() > 0) {
				return $query->row();
			} else {
				return false;
			}
		}





	public function fetchChamadoInteracao($CHI_CHDCodigo) {

		$this->db->select('*');
		$this->db->where('CHI_CHDCodigo', $CHI_CHDCodigo);
		$this->db->order_by("CHI_MomentoInteracao", "DESC");
		$query = $this->db->get('ogm_vw_chamadointeracaodetalhes');
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
	}

	
	}