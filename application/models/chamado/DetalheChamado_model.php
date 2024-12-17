<?php

	class DetalheChamado_model extends CI_Model {

		public function fetchAnexoChamado($CHD_Codigo)
		{

			$this->db->select('*');
			$this->db->where('CHA_CHDCodigo', $CHD_Codigo);
			$query = $this->db->get('ogsv_CHA_AnexoChamado');
			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}
	
		public function fetchogsv_ATG_SelecaoItemGrande($CHD_Codigo)
		{

			$this->db->select('CHD_PJFCodigo');
			$this->db->where('CHD_Codigo', $CHD_Codigo);
			
			$CHD_PJFCodigo = $this->db->get('ogsv_CHD_Chamado')->row()->CHD_PJFCodigo;
		
			$query = $this->db->query('call ogsv_ATG_SelecaoItemGrande(?);', array($CHD_PJFCodigo));

			if ($query->num_rows() > 0) {
				return $query->result_array();
			} else {
				return array();
			}
		}

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

	function fetchDocumentLink($id)
  {
    $this->db->select('CHA_DocumLink');
    $this->db->where('CHA_Codigo', $id);
    $query = $this->db->get('ogsv_CHA_AnexoChamado');
    if ($query->num_rows() > 0) {
      return $query->row()->CHA_DocumLink;
    } else {
      return false;
    }
  }

	
	}